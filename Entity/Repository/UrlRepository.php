<?php

namespace EXS\NormalizedUrlBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class UrlRepository extends EntityRepository
{
    /**
     * Get url by hash
     * 
     * @return Query
     */
    public function getUrlByHash($urlHash)
    {
        $query = $this->createQueryBuilder('u')
            ->select('u')
            ->where('u.hashkey = :hashkey')
            ->setParameter('hashkey', $urlHash)
            ->setMaxResults(1)
            ->getQuery();            
        return $query;
    }    
}
