<?php

namespace App\SkyBundle\Repository;

use App\SkyBundle\Entity\Galaxy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * GalaxyRepository
 */
class GalaxyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Galaxy::class);
    }
}
