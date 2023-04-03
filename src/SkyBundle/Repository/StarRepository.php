<?php

namespace App\SkyBundle\Repository;

use App\SkyBundle\Entity\Galaxy;
use App\SkyBundle\Entity\Star;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * StarRepository
 */
class StarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Star::class);
    }


    public function getUniqueStars(
        Galaxy $inGalaxy,
        array  $hasElements = [],
        string $sortBy = 'size'
    )
    {
        $order = 's.radius';
        if ($sortBy === 'temperature') {
            $order = 's.temperature';
        }

        $dql = $this->createQueryBuilder('s');
        $dql
            ->join('s.elements', 'e', Join::WITH,
                $dql->expr()->in('e.id', ':has_elements')
            )
            ->where(
                $dql->expr()->eq('s.galaxy', ':galaxy_id')
            )
            ->orderBy($order)
            ->setParameter('has_elements', $hasElements)
            ->setParameter('galaxy_id', $inGalaxy);

        return $dql->getQuery()->getResult();
    }
}
