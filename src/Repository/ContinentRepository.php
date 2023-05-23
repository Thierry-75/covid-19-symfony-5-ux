<?php

namespace App\Repository;

use App\Entity\Continent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Continent|null find($id, $lockMode = null, $lockVersion = null)
 * @method Continent|null findOneBy(array $criteria, array $orderBy = null)
 * @method Continent[]    findAll()
 * @method Continent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContinentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Continent::class);
    }

      public function getContinent($zone){
          $em = $this->getEntityManager();
          $query = $em->createQuery("SELECT c.pays,c.zone FROM App:Continent c WHERE c.zone IN (:value) ORDER BY c.zone ASC")->setParameter('value', $zone);
          return $query->getResult();
      }

            public function getOneContinent($zone){
          $em = $this->getEntityManager();
          $query = $em->createQuery("SELECT c.pays FROM App:Continent c WHERE c.zone = :value ORDER BY c.pays ASC")->setParameter('value', $zone);
          return $query->getResult();
      }
}
