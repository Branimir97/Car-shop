<?php

namespace App\Repository;

use App\Entity\AdditionalEquipment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AdditionalEquipment|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdditionalEquipment|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdditionalEquipment[]    findAll()
 * @method AdditionalEquipment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdditionalEquipmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdditionalEquipment::class);
    }
}
