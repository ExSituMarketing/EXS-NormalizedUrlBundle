<?php

namespace EXS\NormalizedUrlBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class HostRepository extends EntityRepository
{
    /**
     * Get host by name
     * 
     * @return Query
     */
    public function getHostByName($hostName)
    {
        $query = $this->createQueryBuilder('h')
            ->select('h')
            ->where('h.name = :hostName')
            ->setParameter('hostName', $hostName)
            ->setMaxResults(1)
            ->getQuery()
            ->useResultCache(true, 600);
        return $query;
    }      
}
