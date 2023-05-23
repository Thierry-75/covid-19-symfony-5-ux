<?php

namespace App\Repository;

use App\Entity\Country;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Country|null find($id, $lockMode = null, $lockVersion = null)
 * @method Country|null findOneBy(array $criteria, array $orderBy = null)
 * @method Country[]    findAll()
 * @method Country[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CountryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Country::class);
    }

  public function getCountry($country){
      $em = $this->getEntityManager();
      $query = $em->createQuery("SELECT c FROM App:Country c WHERE c.name= :result")->setParameter('result', $country);
      return $query->getResult();
  }
 
    public function getCountries($country){
      $em = $this->getEntityManager();
      $query = $em->createQuery("SELECT c FROM App:Country c WHERE c.name IN (:result) ORDER BY c.name ASC ")->setParameter('result', $country);
      return $query->getResult();
  }
  
  public function getCasesDb($world){
      $em = $this->getEntityManager();
      $query = $em->createQuery("SELECT c.cases FROM App:Country c WHERE c.name= :value ")->setParameter('value', $world);
      return $query->getResult();
  }
  
     public function truncateTable(){
        $em = $this->getEntityManager();
        $query = $em->createQuery("DELETE FROM App:COUNTRY  ");
        return $query->getResult();
    }
    
    public function getPaysParZone($zone){
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT p FROM App:Country p  WHERE p.name IN (:result) ORDER BY p.name ASC ")->setParameter('result', $zone);
        return $query->getResult();
    }
}
