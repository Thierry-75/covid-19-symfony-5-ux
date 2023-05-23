<?php

namespace App\Controller;

use App\Entity\Pays;
use App\Entity\Country;
use App\Entity\Continent;
use App\Form\ContinentType;
use App\Service\CallApiService;
use App\Service\ChartJsService;
use App\Service\CallFonctionService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MainController extends AbstractController {

    /**
     * @Route("/", name="app_home")
     */
    public function index(CallApiService $callapiservice, EntityManagerInterface $em, CallFonctionService $callfonctionservice, ChartBuilderInterface $chartBuilder, ChartJsService $chartservice, Request $request, PaginatorInterface $paginator): Response {

        // date en base et date de l'api
        $hier = new DateTime('- 1 day');
        $format_hier = $hier->format('Y-m-d');
        $jour = new DateTime();
        $format_jour = $jour->format("Y-m-d");
        // affectation de la date api
        $data = $callapiservice->getAllDataByDate($format_jour);
        if (empty($data["allFranceDataByDate"])) {
            $data = $callapiservice->getAllDataByDate($format_hier);
        }
        $apiDate = $data['allFranceDataByDate']['101']['date'];     // date france
        $apiPays = $data['allFranceDataByDate']['101']['nom'];    // pays france
        $dateDbase = $em->getRepository(Pays::class)->dateFrance($apiPays);
        if ($dateDbase != null) {
            $jourDb = $dateDbase[0]['date']->format("Y-m-d");
        } else {
            $jourDb = "0000-00-00";
        }
        // comparaison si diff on vide et on enregistre de nouveau 
        if ($jourDb <> $apiDate && $apiDate !=null) {
            $donnees = $em->getRepository(Pays::class)->truncateTable();
            for ($i = 0; $i < 8; $i++) {
                $date = new DateTime('- ' . $i . 'day');
                $donnees = $callapiservice->getAllDataByDate($date->format('Y-m-d'));
                $datas = $donnees['allFranceDataByDate'];
                foreach ($datas as $data) {
                    if (!empty($data)) {
                        $pays = new Pays();
                        $pays->setDate(\DateTime::createFromFormat('Y-m-d', $data['date']));
                        $pays->setNom($data['nom']);
                        $pays->setHospitalisation($data['hospitalises']);
                        $pays->setReanimation($data['reanimation']);
                        $pays->setNouvellesHospitalisations($data['nouvellesHospitalisations']);
                        $pays->setNouvellesReanimations($data["nouvellesReanimations"]);
                        $pays->setDeces($data['deces']);
                        $pays->setGueris($data['gueris']);
                        $pays->setSourceType($data["sourceType"]);
                        $em->persist($pays);
                        $em->flush();
                    }
                }
            }
            //  appel a la base de donnee
            $db = $em->getRepository(Pays::class)->dataFrance($apiPays);
        } else {
            // api et dbase synchrone => appel a la base de donnee
            $db = $em->getRepository(Pays::class)->dataFrance($apiPays);
        }
        // creation des graphiques
        $tableau = $callfonctionservice->france($db);
        $demi_bar = $chartBuilder->createChart(Chart::TYPE_BAR);
        $france_bar = $chartservice->chartFrance($demi_bar, $tableau[0], $tableau[3], $tableau[4], $tableau[6], $tableau[7]);
        // regions de france
        $nom_regions = array("Île-de-France", "Centre-Val de Loire", "Bourgogne-Franche-Comté", "Normandie", "Hauts-de-France", "Grand Est", "Pays de la Loire", "Bretagne", "Nouvelle-Aquitaine", "Occitanie", "Auvergne-Rhône-Alpes", "Provence-Alpes-Côte d'Azur", "Corse", "Guyane", "Guadeloupe", "Martinique", "La Réunion", "Mayotte");
        $date = $tableau[0][0];
        $taux_hospi = $tableau[2][0] - $tableau[2][1];
        $taux_rea = $tableau[3][0] - $tableau[3][1];
        $taux_gueris = $tableau[7][0] - $tableau[7][1];
        $taux_deces = $tableau[6][0] - $tableau[6][1];
        // uniquement les regions et les dom-tom
        $donnees = $em->getRepository(Pays::class)->getRegions($nom_regions, $date);
        //pagination
        $regions = $paginator->paginate(
                $donnees, // Requête contenant les données à paginer (ici nos articles)
                $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
                6 // Nombre de résultats par page
        );
        //vue
        return $this->render('/main/index.html.twig', ['france_bar' => $france_bar, 'sourceType' => $tableau[8], 'nom' => $tableau[1], 'regions' => $regions,
                    'nom' => $tableau[1][0], 'sourceType' => $tableau[8][0], 'date' => $tableau[0][0],
                    'taux_hospi' => $taux_hospi, 'taux_rea' => $taux_rea, 'taux_gueris' => $taux_gueris, 'taux_deces' => $taux_deces, 'donnees' => $donnees, 'mode' => 'france']);
    }

    /**
     * @Route("/region/{region}",name="app_region")
     */
    public function region(Request $request, PaginatorInterface $paginator, string $region, EntityManagerInterface $em, CallFonctionService $callfonctionservice, ChartBuilderInterface $chartBuilder, ChartJsService $chartservice): Response {

        $resultat = $callfonctionservice->tableauRegions($region);
        $regions = $em->getRepository(Pays::class)->getRegion($region);
        $tableau = $callfonctionservice->region($regions);
        // creation des graphiques
        $demi_nouveau = $chartBuilder->createChart(Chart::TYPE_BAR);
        $chartRegionNouveau = $chartservice->chartRegionNouveau($demi_nouveau, $tableau[0], $tableau[4], $tableau[5]);
        $demi_ancien = $chartBuilder->createChart(Chart::TYPE_BAR);
        $chartRegionAncien = $chartservice->chartRegionAncien($demi_ancien, $tableau[0], $tableau[2], $tableau[3]);
        $demi_final = $chartBuilder->createChart(Chart::TYPE_BAR);
        $chartRegionFinal = $chartservice->chartRegionFinal($demi_final, $tableau[0], $tableau[7], $tableau[6]);
        // departements par region
        $donnees = $em->getRepository(Pays::class)->getDepartements($resultat);
        // pagination
        $departements = $paginator->paginate(
                $donnees, // Requête contenant les données à paginer
                $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
                4 // Nombre de résultats par page
        );
        //   dd($regions); 0=date, 1=nom, 2=hospitalisation, 3=reanimation, 4=nellehospi, 5=nellerea, 6=deces, 7=gueris, 8=sourcetYPE
        $taux_nellerea = $tableau[5][0] - $tableau[5][1];
        $taux_nellehospi = $tableau[4][0] - $tableau[4][1];
        $taux_hospi = $tableau[2][0] - $tableau[2][1];
        $taux_rea = $tableau[3][0] - $tableau[3][1];
        $taux_gueris = $tableau[7][0] - $tableau[7][1];
        $taux_deces = $tableau[6][0] - $tableau[6][1];
        //vue
        return $this->render('/main/region.html.twig', ['nouveau_region' => $chartRegionNouveau, 'ancien_region' => $chartRegionAncien, 'final_region' => $chartRegionFinal,
                    'date' => $tableau[0][0], 'nom' => $tableau[1][0], 'sourceType' => $tableau[8][0], 'nouvellesHospitalisations' => $tableau[4][0],
                    'nouvellesReanimations' => $tableau[5][0], 'hospitalisation' => $tableau[2][0], 'reanimation' => $tableau[3][0],
                    'deces' => $tableau[6][0], 'gueris' => $tableau[7][0], 'departements' => $departements,
                    'taux_hospi' => $taux_hospi, 'taux_rea' => $taux_rea, 'taux_gueris' => $taux_gueris, 'taux_deces' => $taux_deces,
                    'taux_nellehospi' => $taux_nellehospi, 'taux_nellerea' => $taux_nellerea, 'mode' => 'region']
        );
    }

    /**
     * @Route("/departement/{department}", name="app_departement")
     */
    public function departement(string $department, EntityManagerInterface $em, CallFonctionService $callfonctionservice, ChartBuilderInterface $chartBuilder, ChartJsService $chartservice): Response {

        $departements = $em->getRepository(Pays::class)->getDepartement($department);
        $tableau = $callfonctionservice->departement($departements);
        // creation des graphiques
        $demi_nouveau = $chartBuilder->createChart(Chart::TYPE_BAR);
        $nouveau = $chartservice->chartDepartementNouveau($demi_nouveau, $tableau[0], $tableau[4], $tableau[5]);
        $demi_ancien = $chartBuilder->createChart(Chart::TYPE_BAR);
        $ancien = $chartservice->chartDepartementAncien($demi_ancien, $tableau[0], $tableau[2], $tableau[3]);
        $demi_final = $chartBuilder->createChart(Chart::TYPE_BAR);
        $final = $chartservice->chartDepartementFinal($demi_final, $tableau[0], $tableau[7], $tableau[6]);
        //   dd($regions); 0=date, 1=nom, 2=hospitalisation, 3=reanimation, 4=nellehospi, 5=nellerea, 6=deces, 7=gueris, 8=sourcetYPE
        $taux_nellerea = $tableau[5][0] - $tableau[5][1];
        $taux_nellehospi = $tableau[4][0] - $tableau[4][1];
        $taux_hospi = $tableau[2][0] - $tableau[2][1];
        $taux_rea = $tableau[3][0] - $tableau[3][1];
        $taux_gueris = $tableau[7][0] - $tableau[7][1];
        $taux_deces = $tableau[6][0] - $tableau[6][1];
        // vue
        return $this->render('main/departement.html.twig',
                        ['nouveau' => $nouveau, 'ancien' => $ancien, 'final' => $final, 'departement' => $tableau[1][0], 'date' => $tableau[0][0], 'sourceType' => $tableau[8][0],
                            'taux_hospi' => $taux_hospi, 'taux_rea' => $taux_rea, 'taux_gueris' => $taux_gueris, 'taux_deces' => $taux_deces, 'taux_nellehospi' => $taux_nellehospi,
                            'taux_nellerea' => $taux_nellerea, 'mode' => 'departements']
        );
    }

    /**
     * @Route("/country", name="app_country")
     */
    public function country(CallApiService $callapiservice, EntityManagerInterface $em, ChartBuilderInterface $chartBuilder, ChartJsService $chartservice, CallFonctionService $callfonctionservice, Request $request, PaginatorInterface $paginator): Response {

        $jour_db = new \DateTime();
        $donnees = $callapiservice->getDataWorld();
        $apiWorldCases = ($donnees[0]["cases"]);
        $world = "World";
        $dbCases = $em->getRepository(Country::class)->getCasesDb($world);
        if ($dbCases != null) {
            $dbWorldCases = ($dbCases[0]['cases']);
        } else {
            $dbWorldCases = 0;
        }
        if ($apiWorldCases <> $dbWorldCases) {
            $datas = $em->getRepository(Country::class)->truncateTable();
            foreach ($donnees as $donnee) {
                $country = new Country();
                $country->setDate($jour_db);
                $country->setName($donnee['country']);
                $country->setCases($donnee['cases']);
                $country->setTodayCases($donnee['todayCases']);
                $country->setDeaths($donnee['deaths']);
                $country->setTodayDeaths($donnee['todayDeaths']);
                $country->setRecovered($donnee['recovered']);
                $country->setActive($donnee['active']);
                $country->setCritical($donnee['critical']);
                $country->setCasesPerOneMillion($donnee['casesPerOneMillion']);
                $country->setDeathsPerOneMillion($donnee['deathsPerOneMillion']);
                $country->setTotalTests($donnee['totalTests']);
                $country->setTestsPerOneMillion($donnee['testsPerOneMillion']);
                $em->persist($country);
                $em->flush();
            }

            $valeur = "World";
            $worlds = $em->getRepository(Country::class)->getCountry($valeur);
        } else {
            $valeur = ["World"];
            $worlds = $em->getRepository(Country::class)->getCountry($valeur);
        }

        $zone = ['Amérique du Nord', 'Amérique du Sud', 'Asie', 'Afrique', 'Océanie', 'Europe', 'Moyen-Orient', 'Monde'];
        $continents = $em->getRepository(Continent::class)->getContinent($zone);
        $countries = $em->getRepository(Country::class)->findAll();

        $regions = $callfonctionservice->triContinents($countries, $continents);
        $datas_continents = $callfonctionservice->totalContinent($regions);

        $continent_datas = $paginator->paginate(
                $datas_continents,
                $request->query->getInt('page', 1),
                4
        );

        // construction du graphique mondiale
        $tableau = $callfonctionservice->country($worlds);
        $demi_world = $chartBuilder->createChart(Chart::TYPE_BAR);
        // 0=>name,1=>cases,3=>deaths,5=>recovered,6=>active,9=>deathsPerMilion
        $world_bar = $chartservice->chartWorld($demi_world, $tableau[0], $tableau[1], $tableau[3], $tableau[5], $tableau[6], $tableau[9]);
        //vue
        return $this->render("main/country.html.twig", ['country' => $tableau[0][0], 'chartWorld' => $world_bar,
                    'cas' => $tableau[1][0], 'deces' => $tableau[3][0], 'gueris' => $tableau[5][0], 'contamines' => $tableau[6][0], 'hospitalise' => $tableau[7][0],
                    'cas_million' => $tableau[8][0], 'deces_million' => $tableau[9][0], 'mode' => 'monde', 'continent_datas' => $continent_datas
                        ]
        );
    }

    /**
     * @Route("/continent/{continent}",name="app_continent")
     */
    public function continent(string $continent, EntityManagerInterface $em, CallFonctionService $callfonctionservice, ChartBuilderInterface $chartBuilder, ChartJsService $chartservice, Request $request, PaginatorInterface $paginator): Response {

        $regions = $em->getRepository(Continent::class)->getOneContinent($continent);
        $countries = $em->getRepository(Country::class)->getCountries($regions);
        $date =$countries[0]->getDate();
        $dateFormat = $date->Format('d-m-Y');
        // construction du graphique mondiale
        $tableau = $callfonctionservice->country($countries);
        $cases[] = array_sum($tableau[1]); // cases
        $cas = array_sum($tableau[1]); // cases
        $casJour = array_sum($tableau[2]);  // todayCases
        $deces[] = array_sum($tableau[3]); // deaths
        $morts = array_sum($tableau[3]); // deaths
        $decesJour = array_sum($tableau[4]); //todayDeaths
        $gueris[] = array_sum($tableau[5]); //recovered
        $guerie = array_sum($tableau[5]); //recovered
        $contamine[] = array_sum($tableau[6]);  //active
        $contamines = array_sum($tableau[6]);  //active
        $hospitalise = array_sum($tableau[7]); //critical
        $casMillion = array_sum($tableau[8]); // casPerOneMillion
        $deathMillion[] = array_sum($tableau[9]); //deathPerOneMillion
        $deathMillions = array_sum($tableau[9]); //deathPerOneMillion
        $demi_world = $chartBuilder->createChart(Chart::TYPE_BAR);
        //1=>cases,3=>deaths,5=>recovered,6=>active,9=>deathsPerMilion
        $world_bar = $chartservice->chartContinent($demi_world, $cases, $deces, $gueris, $contamine, $deathMillion);

        $continent_datas = $paginator->paginate(
                $countries,
                $request->query->getInt('page', 1),
                10
        );

        return $this->render('main/continent.html.twig', [
                    'continent' => $continent, 'chartContinent' => $world_bar, 'mode' => 'continent','date' =>$dateFormat,
                    'cas' => $cas, 'deces' => $morts, 'gueris' => $guerie, 'contamines' => $contamines, 'hospitalise' => $hospitalise,
                    'cas_million' => $casMillion, 'deces_million' => $deathMillions, 'continent_datas' => $continent_datas
        ]);
    }

    /**
     * @Route("/pays/{pays}",name="app_pays")
     */
    public function findPays(string $pays, EntityManagerInterface $em, CallFonctionService $callfonctionservice, ChartBuilderInterface $chartBuilder, ChartJsService $chartservice, Request $request, PaginatorInterface $paginator): Response {

        $compareCountries = ['France', $pays];
        $countries = $em->getRepository(Country::class)->getCountries($compareCountries);
       
        $tableau = $callfonctionservice->pays($countries);
        // 0=>date, 1=>nom, 2=>cas, 3=>deces, 4=>gueris, 5=>contamine, 6=>hospitalise, 7=> casMillion, 8=>decesMillion
        $nom1 = $tableau[1][0] ;
        $nom2 = $tableau[1][1];
        $date = $tableau[0][0];
        
        $compare_demi = $chartBuilder->createChart(Chart::TYPE_BAR);
                                                                                           //  $chart, $label, $cases, $deces, $gueris, $hospitalise, $casMillion, $decesMillion
        $compare_pays = $chartservice->chartPaysCompare($compare_demi, $tableau[1], $tableau[2], $tableau[3],$tableau[4],$tableau[6],$tableau[7]);
        return $this->render("main/pays.html.twig", ['nom1' => $nom1,'nom2'=>$nom2, 'chartPays' => $compare_pays,'date'=>$date,'donnees'=>$tableau,
         'mode'=>'pays' ]);
    }

    /**
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param ValidatorInterface $validator
     * @return Response
     * @Route("/addform",name="app_form")
     */
    public function saisiePays(Request $request, EntityManagerInterface $em, ValidatorInterface $validator): Response {
        $continent = new Continent();
        $form_country = $this->createForm(ContinentType::class, $continent);
        $form_country->handleRequest($request);
        if ($request->isMethod("POST")) {
            $errors = $validator->validate($continent);
            if (count($errors) > 0) {
                return $this->render('/main/country_add.html.twig', ['form_continent' => $form_country->createView(), 'errors' => $errors]);
            }
            if ($form_country->isSubmitted() && $form_country->isValid()) {
                $em->persist($continent);
                $em->flush();
                return $this->redirectToRoute("app_form");
            }
        }
        return $this->render('/main/country_add.html.twig', ['form_continent' => $form_country->createView(),'mode'=>'saisie']);
    }

}
