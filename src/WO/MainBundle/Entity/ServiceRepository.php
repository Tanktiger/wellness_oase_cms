<?php

namespace WO\MainBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ServiceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ServiceRepository extends EntityRepository
{
    /**
     * findet Services über den Catgory Slug und wenn sie online sind
     * @param null $slug
     * @return array
     */
    public function findByCategory($slug = null, $online = 1) {
        $q = $this
            ->createQueryBuilder('s')
            ->select('s')
            ->leftJoin('s.category', 'c')
            ->where('c.slug = :slug')
            ->where('s.show_online= :true')
            ->where('c.show_online= :true')
            ->setParameter('slug', $slug)
            ->setParameter('true', $online)
            ->getQuery();

        $services = $q->getArrayResult();

        return $services;
    }
}
