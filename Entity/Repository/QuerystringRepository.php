<?php

namespace EXS\NormalizedUrlBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class QuerystringRepository extends EntityRepository
{
    /**
     * Get querystring by name
     * 
     * @return Query
     */
    public function getQuerystringByName($qsName)
    {
        $query = $this->createQueryBuilder('q')
            ->select('q')
            ->where('q.name = :qsName')
            ->setParameter('qsName', $qsName)
            ->setMaxResults(1)
            ->getQuery()
            ->useResultCache(true, 600);
        return $query;
    }       
}
