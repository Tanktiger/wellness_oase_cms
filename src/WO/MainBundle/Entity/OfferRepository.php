<?php

namespace WO\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

/**
 */
class OfferRepository extends EntityRepository
{
    public function getAllOffers() {
        $now = new \DateTime('now');
        $q = $this
            ->createQueryBuilder('o')
            ->select('o')
            ->where('o.offerEnd > :date')
            ->setParameter('date', $now->format('Y-m-d H:i:s'))
            ->getQuery();
//        var_dump($q->getSQL(),$now->format('Y-m-d H:i:s'));
//        exit(PHP_EOL . __FILE__ . ' on Line: ' . __LINE__ . ' in Function: ' . __FUNCTION__);
        return new ArrayCollection($q->getResult());
    }
}
