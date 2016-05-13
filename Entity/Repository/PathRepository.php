<?php

namespace EXS\NormalizedUrlBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class PathRepository extends EntityRepository
{
    /**
     * Get path by name
     * 
     * @return Query
     */
    public function getPathByName($pathName)
    {
        $query = $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.name = :pathName')
            ->setParameter('pathName', $pathName)
            ->setMaxResults(1)
            ->getQuery()
            ->useResultCache(true, 600);
        return $query;
    }       
}
