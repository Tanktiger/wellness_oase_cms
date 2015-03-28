<?php

namespace WO\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/{page}", name="homepage", defaults={"page" = false})
     * @Template()
     */
    public function indexAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $config = $em->find('WOMainBundle:Config', 1);
        if ($config->getOffline() && $config->getOffline() == 1) {
            return $this->render('WOMainBundle:Default:showOfflinePage.html.twig');
        }
        if (isset($page) && trim($page) != '' && false !== $page) {
            $main = $em->getRepository('WOMainBundle:Page')->getPageBySlug($page);
        } else {
            $main = $em->getRepository('WOMainBundle:Page')->getSinglePageByType('homepage');
        }
        return $this->render('WOMainBundle:Default:showPage.html.twig', array('page' => $main));
    }

    /**
     * @Route("/{page}/{slug}", name="show_page")
     * @Template()
     * @param $slug
     */
    public function showPageAction($page, $slug) {
        $em = $this->getDoctrine()->getManager();
        $config = $em->find('WOMainBundle:Config', 1);
        if ($config->getOffline() && $config->getOffline() == 1) {
            return $this->render('WOMainBundle:Default:showOfflinePage.html.twig');
        }
        if ((isset($page) && trim($page) != '' && false !== $page)
            && (isset($slug) && trim($slug) != '' && false !== $slug)
        ) {
            $main = $em->getRepository('WOMainBundle:Page')->getPageFromParentAndSlug($page, $slug);
        } else {
            $main = $em->getRepository('WOMainBundle:Page')->getSinglePageByType('homepage');
        }

        return array('page' => $main);
    }

    public function showOfflinePageAction() {
        return array();
    }
}
