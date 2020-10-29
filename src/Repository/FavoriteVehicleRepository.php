<?php

namespace App\Repository;

use App\Entity\FavoriteVehicle;
use App\Entity\User;
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

    public function findAllAvailableAndVisibleByUser()
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
