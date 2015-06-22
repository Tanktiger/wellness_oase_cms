<?php
namespace WO\MainBundle\Services;
use \Doctrine\ORM\EntityManager;

/**
 * Creates the event table
 * Class ConfigHelper
 * @package WO\MainBundle\Services
 */
class ConfigHelper {
    private $em;
//    private $router;

    public function __construct ($router, EntityManager $entityManager) {
        $this->em = $entityManager;
//        $this->router = $router;
    }
    public function get() {
        return $this->em->find('WOMainBundle:Config', 1);
    }
}