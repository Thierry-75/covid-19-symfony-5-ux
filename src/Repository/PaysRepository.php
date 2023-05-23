<?php

namespace App\Repository;

use App\Entity\Pays;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pays|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pays|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pays[]    findAll()
 * @method Pays[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaysRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pays::class);
    }

    public function dateFrance($pays)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT p.date FROM App:Pays p WHERE p.nom = :value ' )
                ->setParameter('value',$pays);
        return $query->getResult();
    }
    
    public function dataFrance($pays)
    {                                                                                                               //ORDER BY a.id ASC
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT p FROM App\Entity\Pays p WHERE p.nom =:value ORDER BY p.date DESC ")->setParameter('value', $pays)
         ->setMaxResults(7);
        return $query->getResult();
    }
    
    public function getRegions($nom_regions,$date)
    {
        $em = $this->getEntityManager();
        $query= $em->createQuery("SELECT DISTINCT p.date,p.nom,p.deces,p.gueris FROM App\Entity\Pays p WHERE p.nom IN (:result) AND p.date = :value ")->setParameter('result', $nom_regions)
                ->setParameter('value', $date);
        return $query->getResult();
    }
    
    public function getRegion($region)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT p FROM App:Pays p WHERE p.nom = :value ORDER BY p.date DESC")->setParameter('value', $region)->setMaxResults(7);
        return $query->getResult();
    }
    
        public function getDepartements($nom_departements)
    {
        $em = $this->getEntityManager();
        $query= $em->createQuery("SELECT p FROM App\Entity\Pays p WHERE p.nom  IN (:result)")->setParameter('result', $nom_departements)->setMaxResults(count($nom_departements));
        return $query->getResult();
    }
    
    public function getDepartement($department)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT p FROM App:PAYS p WHERE p.nom= :value ORDER BY p.date DESC")->setParameter('value', $department)->setMaxResults(7);
        return $query->getResult();
    }
    
    public function truncateTable(){
        $em = $this->getEntityManager();
        $query = $em->createQuery("DELETE FROM App:PAYS  ");
        return $query->getResult();
    }
}
