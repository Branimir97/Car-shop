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
}
