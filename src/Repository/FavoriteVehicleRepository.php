<?php

namespace App\Repository;

use App\Entity\FavoriteVehicle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FavoriteVehicle|null find($id, $lockMode = null, $lockVersion = null)
 * @method FavoriteVehicle|null findOneBy(array $criteria, array $orderBy = null)
 * @method FavoriteVehicle[]    findAll()
 * @method FavoriteVehicle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavoriteVehicleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FavoriteVehicle::class);
    }

    // /**
    //  * @return FavoriteVehicle[] Returns an array of FavoriteVehicle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FavoriteVehicle
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
