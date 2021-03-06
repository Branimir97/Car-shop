<?php

namespace App\Repository;

use App\Entity\Vehicle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vehicle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vehicle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vehicle[]    findAll()
 * @method Vehicle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehicleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicle::class);
    }

    public function findAllAvailableAndVisible()
    {
        $query = $this->createQueryBuilder('v')
            ->where('v.visibility = :visibility')
            ->andWhere('v.status = :statusStock')
            ->orWhere('v.status = :statusArrival')
            ->setParameter('visibility', 1)
            ->setParameter('statusStock', "In stock")
            ->setParameter('statusArrival', 'In arrival')
            ->orderBy('v.id', 'DESC');

        return $query->getQuery()->execute();
    }
}
