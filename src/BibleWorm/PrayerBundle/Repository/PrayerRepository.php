<?php

namespace BibleWorm\PrayerBundle\Repository;

use Doctrine\ORM\EntityRepository;


class PrayerRepository extends EntityRepository
{
    public function findShared()
    {
        $query = $this->getEntityManager()
            ->createQuery('
                SELECT p FROM BibleWormPrayerBundle:Prayer p
                WHERE p.isPublic = true
                WHERE p.isActive = true'
            );
        
        return $this->getQueryResult($query);
    }
    
    public function findActiveByUserId($userId)
    {
        $query = $this->getEntityManager()
            ->createQuery('
                SELECT p FROM BibleWormPrayerBundle:Prayer p
                JOIN p.user u
                WHERE u.id = :id
                WHERE p.isActive = true'
            )->setParameter('id', $userId);
        
        return $this->getQueryResult($query);
    }
    
    public function findRecentlyArchivedByUserId($userId)
    {
        $query = $this->getEntityManager()
            ->createQuery('
                SELECT p FROM BibleWormPrayerBundle:Prayer p
                JOIN p.user u
                WHERE u.id = :id
                WHERE p.isActive = false'
                // TODO add date range
            )->setParameter('id', $userId);
        
        return $this->getQueryResult($query);
    }
    
    /**
     * Wraps the getResult call in a try/catch block
     */
    protected function getQueryResult($query)
    {
        try {
            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
}