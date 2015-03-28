<?php

namespace WO\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class CMSController
 * @package WO\MainBundle\Controller
 * @Route("/admin")
 */
class CMSController extends Controller
{
    /**
     * @Route("/", name="admin_index")
     * @Template()
     */
    public function indexAction()
    {
        return array(
                // ...
            );
    }

}
