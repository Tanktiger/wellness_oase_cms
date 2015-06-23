<?php

namespace WO\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Service controller.
 *
 * @Route("/api")
 */
class ApiController extends Controller
{
    /**
     * @Route("/get-service")
     * @Method("GET")
     * @Template()
     */
    public function getServiceOffersAction(Request $request) {
        $slug = $request->get('slug');
        $callback = $request->get('callback');
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('WOMainBundle:Service')->findByCategory($slug);
        $qb = $em->createQueryBuilder();
        $category = $qb->select('c')
            ->from('WOMainBundle:ServiceCategory', 'c')
            ->where('c.show_online= :true')
            ->andWhere('c.slug= :slug')
            ->setParameter('true', 1)
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getSingleResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        $response = new JsonResponse(array('entities' => $entities, 'category' => $category), 200, array());
        $response->setCallback($callback);
        return $response;
    }

    /**
     * @Route("/get-service-categories")
     * @Method("GET")
     * @Template()
     */
    public function getServiceCategoriesAction(Request $request) {
        $callback = $request->get('callback');

        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();

        $categories = $qb->select('c')
            ->from('WOMainBundle:ServiceCategory', 'c')
            ->where('c.show_online= :true')
            ->orderBy('c.position', 'ASC')
            ->setParameter('true', 1)
            ->getQuery()
            ->getArrayResult();
        $response = new JsonResponse(array('categories' => $categories), 200, array());
        $response->setCallback($callback);
        return $response;
    }
}
