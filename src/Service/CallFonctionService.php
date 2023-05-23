<?php

namespace App\Service;

class CallFonctionService {

    public function france($dbs): Array {
        foreach ($dbs as $db) {
            $label[] = $db->getDate()->format('Y-m-d');
            $nom[] = $db->getNom();
            $hospitalisation[] = $db->getHospitalisation();
            $reanimation[] = $db->getReanimation();
            $nouvellesHospitalisations[] = $db->getNouvellesHospitalisations();
            $nouvellesReanimations[] = $db->getNouvellesReanimations();
            $deces[] = $db->getDeces();
            $gueris[] = $db->getGueris();
            $sourceType[] = $db->getSourceType();
        }
        return array($label, $nom, $hospitalisation, $reanimation, $nouvellesHospitalisations, $nouvellesReanimations, $deces, $gueris, $sourceType);
    }
    
        public function pays($dbs): Array {
        foreach ($dbs as $db) {
            $date[] = $db->getDate()->format('Y-m-d');
            $nom[] = $db->getName();
            $cases[] = $db->getCases();
            $deces[] = $db->getDeaths();
            $gueris[] = $db->getRecovered();
            $contamine[] = $db->getActive();
            $hospitalise[] = $db->getCritical();
            $casMillion[] = $db->getCasesPerOneMillion();
            $decesMillion[] = $db->getDeathsPerOneMillion();
        }
        // date,nom,cas,deces,gueris,contamine,hospitalise,casMillion,decesMillion
        return array($date,$nom,$cases,$deces,$gueris,$contamine,$hospitalise,$casMillion,$decesMillion);
    }

    public function region($departements): Array {
        foreach ($departements as $departement) {
            $label[] = $departement->getDate()->format('Y-m-d');
            $nom[] = $departement->getNom();
            $hospitalisation[] = $departement->getHospitalisation();
            $reanimation[] = $departement->getReanimation();
            $nouvellesHospitalisations[] = $departement->getNouvellesHospitalisations();
            $nouvellesReanimations[] = $departement->getNouvellesReanimations();
            $deces[] = $departement->getDeces();
            $gueris[] = $departement->getGueris();
            $sourceType[] = $departement->getSourceType();
        }

        return array($label, $nom, $hospitalisation, $reanimation, $nouvellesHospitalisations, $nouvellesReanimations, $deces, $gueris, $sourceType);
    }

    public function departement($departements): Array {
        foreach ($departements as $departement) {
            $label[] = $departement->getDate()->format('Y-m-d');
            $nom[] = $departement->getNom();
            $hospitalisation[] = $departement->getHospitalisation();
            $reanimation[] = $departement->getReanimation();
            $nouvellesHospitalisations[] = $departement->getNouvellesHospitalisations();
            $nouvellesReanimations[] = $departement->getNouvellesReanimations();
            $deces[] = $departement->getDeces();
            $gueris[] = $departement->getGueris();
            $sourceType[] = $departement->getSourceType();
        }
        return array($label, $nom, $hospitalisation, $reanimation, $nouvellesHospitalisations, $nouvellesReanimations, $deces, $gueris, $sourceType);
    }

    public function tableauRegions($region): Array {

        if ($region == "Auvergne-Rhône-Alpes") {
            $result = ["Ain", "Allier", "Ardèche", "Cantal", "Drôme", "Isère", "Loire"];
        }
        if ($region == "Bourgogne-Franche-Comté") {
            $result = ["Côte-d'Or", "Doubs", "Jura", "Nièvre", "Haute-Saône", "Saône-et-Loire", "Yonne"];
        }
        if ($region == "Bretagne") {
            $result = ["Côtes-d'Armor", "Finistère", "Ille-et-Vilaine", "Morbihan"];
        }
        if ($region == "Centre-Val de Loire") {
            $result = ["Cher", "Eure-et-Loir", "Indre", "Indre-et-Loire", "Loir-et-Cher", "Loiret"];
        }
        if ($region == "Corse") {
            $result = ["Corse-du-Sud", "Haute-Corse"];
        }
        if ($region == "Grand Est") {
            $result = ["Ardennes", "Aube", "Bas-Rhin", "Haute-Marne", "Haut-Rhin", "Marne", "Meurthe-et-Moselle", "Meuse", "Vosges"];
        }
        if ($region == "Guadeloupe") {
            $result = ["Guadeloupe"];
        }
        if ($region == "Guyane") {
            $result = ["Guyane"];
        }
        if ($region == "Hauts-de-France") {
            $result = ["Aisne", "Nord", "Oise", "Pas-de-Calais", "Somme"];
        }
        if ($region == "La Réunion") {
            $result = ["La Réunion"];
        }
        if ($region == "Martinique") {
            $result = ["Martinique"];
        }
        if ($region == "Mayotte") {
            $result = ["Mayotte"];
        }
        if ($region == "Normandie") {
            $result = ["Calvados", "Eure", "Manche", "Orne", "Seine-Maritime"];
        }
        if ($region == "Nouvelle-Aquitaine") {
            $result = ["Charente", "Charente-Maritime", "Corrèze", "Creuse", "Dordogne", "Gironde", "Landes", "Lot-et-Garonne",
                "Pyrénées-Atlantiques", "Deux-Sèvres", "Vienne", "Haute-Vienne"];
        }
        if ($region == "Occitanie") {
            $result = ["Ariège", "Aude", "Aveyron", "Gard", "Haute-Garonne", "Gers", "Hérault", "Lot", "Lozère", "Hautes-Pyrénées", "Pyrénées-Orientales", "Tarn", "Tarn-et-Garonne"];
        }
        if ($region == "Pays de la Loire") {
            $result = ["Loire-Atlantique", "Maine-et-Loire", "Mayenne", "Sarthe", "Vendée"];
        }
        if ($region == "Provence-Alpes-Côte d'Azur") {
            $result = ["Alpes-de-Haute-Provence", "Hautes-Alpes", "Alpes-Maritimes", "Bouches-du-Rhône", "Var", "Vaucluse"];
        }
        if ($region == "Île-de-France") {
            $result = ["Paris", "Seine-et-Marne", "Yvelines", "Essonne", "Hauts-de-Seine", "Seine-Saint-Denis", "Val-de-Marne", "Val-d'Oise"];
        }
        return $result;
    }

    public function country($monde): Array {
        foreach ($monde as $world) {
            $names[] = $world->getName();
            $cases[] = $world->getCases();
            $todayCases[] = $world->getTodayCases();
            $deaths[] = $world->getDeaths();
            $todayDeaths[] = $world->getTodayDeaths();
            $recovered[] = $world->getRecovered();
            $active[] = $world->getActive();
            $critical[] = $world->getCritical();
            $casesPerOneMillion[] = $world->getCasesPerOneMillion();
            $deathsPerOneMillion[] = $world->getDeathsPerOneMillion();
            $totalTests[] = $world->getTotalTests();
            $testsPerOneMillion[] = $world->getTestsPerOneMillion();
        }
        return array($names, $cases, $todayCases, $deaths, $todayDeaths, $recovered, $active, $critical, $casesPerOneMillion, $deathsPerOneMillion, $totalTests, $testsPerOneMillion);
    }

    public function triContinents($countries, $continents):Array {
        foreach ($countries as $country) {
            foreach ($continents as $continent) {
                if ($country->getName() == $continent['pays']) {
                    if ($continent['zone'] == 'Amérique du Nord') {
                        $ameriqueNord[] = $country;
                    }
                    if ($continent['zone'] == 'Amérique du Sud') {
                        $ameriqueSud[] = $country;
                    }
                    if ($continent['zone'] == 'Asie') {
                        $asie[] = $country;
                    }
                    if ($continent['zone'] == 'Afrique') {
                        $afrique[] = $country;
                    }
                    if ($continent['zone'] == 'Océanie') {
                        $oceanie[] = $country;
                    }
                    if ($continent['zone'] == 'Europe') {
                        $europe[] = $country;
                    }
                    if ($continent['zone'] == 'Moyen-Orient') {
                        $moyenOrient[] = $country;
                    }
                    if ($continent['zone'] == 'Monde') {
                        $monde[] = $country;
                    }
                }
            }
        }
        return array($ameriqueNord, $ameriqueSud, $asie, $afrique, $oceanie, $europe, $moyenOrient, $monde);
    }

    public function totalContinent($regions):Array {
        foreach ($regions as $key => $values) {
            foreach ($values as $value) {
                if ($key == 0) {
                    $casesJourAmeriqueNord[] = $value->getTodayCases();
                    $decesJourAmeriqueNord[] = $value->getTodayDeaths();
                    $guerisAmeriqueNord[] = $value->getRecovered();
                    $contaminesAmeriqueNord[] = $value->getActive();
                    $casMillionAmeriqueNord[] = $value->getCasesPerOneMillion();
                    $cumulCasAmeriqueNord[] = $value->getCases();
                    $cumulDeathAmeriqueNord[] = $value->getDeaths();
                    $hospitalisesAmeriqueNord[] = $value->getCritical();
                    $decesMillionAmeriqueNord[] = $value->getDeathsPerOneMillion();
                    $ameriqueNord = "Amérique du Nord";
                }
                if ($key == 1) {
                    $casesJourAmeriqueSud[] = $value->getTodayCases();
                    $decesJourAmeriqueSud[] = $value->getTodayDeaths();
                    $guerisAmeriqueSud[] = $value->getRecovered();
                    $contaminesAmeriqueSud[] = $value->getActive();
                    $casMillionAmeriqueSud[] = $value->getCasesPerOneMillion();
                    $cumulCasAmeriqueSud[] = $value->getCases();
                    $cumulDeathAmeriqueSud[] = $value->getDeaths();
                    $hospitalisesAmeriqueSud[] = $value->getCritical();
                    $decesMillionAmeriqueSud[] = $value->getDeathsPerOneMillion();
                    $ameriqueSud = "Amérique du Sud";
                }
                if ($key == 2) {
                    $casesJourAsie[] = $value->getTodayCases();
                    $decesJourAsie[] = $value->getTodayDeaths();
                    $guerisAsie[] = $value->getRecovered();
                    $contaminesAsie[] = $value->getActive();
                    $casMillionAsie[] = $value->getCasesPerOneMillion();
                    $cumulCasAsie[] = $value->getCases();
                    $cumulDeathAsie[] = $value->getDeaths();
                    $hospitalisesAsie[] = $value->getCritical();
                    $decesMillionAsie[] = $value->getDeathsPerOneMillion();
                    $asie = "Asie";
                }
                if ($key == 3) {
                    $casesJourAfrique[] = $value->getTodayCases();
                    $decesJourAfrique[] = $value->getTodayDeaths();
                    $guerisAfrique[] = $value->getRecovered();
                    $contaminesAfrique[] = $value->getActive();
                    $casMillionAfrique[] = $value->getCasesPerOneMillion();
                    $cumulCasAfrique[] = $value->getCases();
                    $cumulDeathAfrique[] = $value->getDeaths();
                    $hospitalisesAfrique[] = $value->getCritical();
                    $decesMillionAfrique[] = $value->getDeathsPerOneMillion();
                    $afrique = "Afrique";
                }
                if ($key == 4) {
                    $casesJourOceanie[] = $value->getTodayCases();
                    $decesJourOceanie[] = $value->getTodayDeaths();
                    $guerisOceanie[] = $value->getRecovered();
                    $contaminesOceanie[] = $value->getActive();
                    $casMillionOceanie[] = $value->getCasesPerOneMillion();
                    $cumulCasOceanie[] = $value->getCases();
                    $cumulDeathOceanie[] = $value->getDeaths();
                    $hospitalisesOceanie[] = $value->getCritical();
                    $decesMillionOceanie[] = $value->getDeathsPerOneMillion();
                    $oceanie = "Océanie";
                }
                if ($key == 5) {
                    $casesJourEurope[] = $value->getTodayCases();
                    $decesJourEurope[] = $value->getTodayDeaths();
                    $guerisEurope[] = $value->getRecovered();
                    $contaminesEurope[] = $value->getActive();
                    $casMillionEurope[] = $value->getCasesPerOneMillion();
                    $cumulCasEurope[] = $value->getCases();
                    $cumulDeathEurope[] = $value->getDeaths();
                    $hospitalisesEurope[] = $value->getCritical();
                    $decesMillionEurope[] = $value->getDeathsPerOneMillion();
                    $europe = "Europe";
                }
                if ($key == 6) {
                    $casesJourMoyenOrient[] = $value->getTodayCases();
                    $decesJourMoyenOrient[] = $value->getTodayDeaths();
                    $guerisMoyenOrient[] = $value->getRecovered();
                    $contaminesMoyenOrient[] = $value->getActive();
                    $casMillionMoyenOrient[] = $value->getCasesPerOneMillion();
                    $cumulCasMoyenOrient[] = $value->getCases();
                    $cumulDeathMoyenOrient[] = $value->getDeaths();
                    $hospitalisesMoyenOrient[] = $value->getCritical();
                    $decesMillionMoyenOrient[] = $value->getDeathsPerOneMillion();
                    $moyenOrient = "Moyen-Orient";
                }
                if ($key == 7) {
                    $casesJourMonde[] = $value->getTodayCases();
                    $decesJourMonde[] = $value->getTodayDeaths();
                    $guerisMonde[] = $value->getRecovered();
                    $contaminesMonde[] = $value->getActive();
                    $casMillionMonde[] = $value->getCasesPerOneMillion();
                    $cumulCasMonde[] = $value->getCases();
                    $cumulDeathMonde[] = $value->getDeaths();
                    $hospitalisesMonde[] = $value->getCritical();
                    $decesMillionMonde[] = $value->getDeathsPerOneMillion();
                    $earth = "Monde";
                }
            }
        }

        $ameriqueNord = [array_sum($casesJourAmeriqueNord), array_sum($decesJourAmeriqueNord), array_sum($guerisAmeriqueNord), array_sum($contaminesAmeriqueNord)
            , array_sum($casMillionAmeriqueNord), array_sum($cumulCasAmeriqueNord), array_sum($cumulDeathAmeriqueNord),
            array_sum($hospitalisesAmeriqueNord), array_sum($decesMillionAmeriqueNord), $ameriqueNord];

        $ameriqueSud = [array_sum($casesJourAmeriqueSud), array_sum($decesJourAmeriqueSud), array_sum($guerisAmeriqueSud), array_sum($contaminesAmeriqueSud)
            , array_sum($casMillionAmeriqueSud), array_sum($cumulCasAmeriqueSud), array_sum($cumulDeathAmeriqueSud),
            array_sum($hospitalisesAmeriqueSud), array_sum($decesMillionAmeriqueSud), $ameriqueSud];

        $asie = [array_sum($casesJourAsie), array_sum($decesJourAsie), array_sum($guerisAsie), array_sum($contaminesAsie)
            , array_sum($casMillionAsie), array_sum($cumulCasAsie), array_sum($cumulDeathAsie),
            array_sum($hospitalisesAsie), array_sum($decesMillionAsie), $asie];

        $afrique = [array_sum($casesJourAfrique), array_sum($decesJourAfrique), array_sum($guerisAfrique), array_sum($contaminesAfrique)
            , array_sum($casMillionAfrique), array_sum($cumulCasAfrique), array_sum($cumulDeathAfrique),
            array_sum($hospitalisesAfrique), array_sum($decesMillionAfrique), $afrique];

        $oceanie = [array_sum($casesJourOceanie), array_sum($decesJourOceanie), array_sum($guerisOceanie), array_sum($contaminesOceanie)
            , array_sum($casMillionOceanie), array_sum($cumulCasOceanie), array_sum($cumulDeathOceanie),
            array_sum($hospitalisesOceanie), array_sum($decesMillionOceanie), $oceanie];

        $europe = [array_sum($casesJourEurope), array_sum($decesJourEurope), array_sum($guerisEurope), array_sum($contaminesEurope)
            , array_sum($casMillionEurope), array_sum($cumulCasEurope), array_sum($cumulDeathEurope),
            array_sum($hospitalisesEurope), array_sum($decesMillionEurope), $europe];

        $moyenOrient = [array_sum($casesJourMoyenOrient), array_sum($decesJourMoyenOrient), array_sum($guerisMoyenOrient), array_sum($contaminesMoyenOrient)
            , array_sum($casMillionMoyenOrient), array_sum($cumulCasMoyenOrient), array_sum($cumulDeathMoyenOrient),
            array_sum($hospitalisesMoyenOrient), array_sum($decesMillionMoyenOrient), $moyenOrient];

        $monde = [array_sum($casesJourMonde), array_sum($decesJourMonde), array_sum($guerisMonde), array_sum($contaminesMonde)
            , array_sum($casMillionMonde), array_sum($cumulCasMonde), array_sum($cumulDeathMonde),
            array_sum($hospitalisesMonde), array_sum($decesMillionMonde), $earth];

        return array($ameriqueNord, $ameriqueSud, $asie, $afrique, $oceanie, $europe, $moyenOrient, $monde);
    }



    public function AdditionContinent($tableaux) {
        // 1 =>today_case, 2=>today_death, 3 =>gueris, 4=>contamines,5=>cas_par_million,6=>cumul_cas,7=>cummul_deaths,8=>hospitalises,9=>death_per_million
        return array(array_sum($tableaux[1]),array_sum($tableaux[2]),array_sum($tableaux[3]),array_sum($tableaux[4]),array_sum($tableaux[5]),
         array_sum($tableaux[6]),array_sum($tableaux[7]),array_sum($tableaux[8]),array_sum($tableaux[9])
            );
        
    }

}
