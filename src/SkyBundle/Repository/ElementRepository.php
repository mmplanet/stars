<?php

namespace App\SkyBundle\Repository;

use App\SkyBundle\Entity\Element;
use App\SkyBundle\Entity\Galaxy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * ElementRepository
 */
class ElementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Element::class);
    }

    public function getGalaxyElements(Galaxy $galaxy)
    {
        $dql = $this->createQueryBuilder('e');

        return $dql
            ->join('e.stars', 's', Join::WITH,
                $dql->expr()->eq('s.galaxy', ':galaxy'))
            ->setParameter('galaxy', $galaxy)
            ->getQuery()->getResult();
    }
}
