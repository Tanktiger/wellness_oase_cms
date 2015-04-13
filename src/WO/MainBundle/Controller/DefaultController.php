<?php

namespace WO\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        if($request->isXmlHttpRequest()) {
            return new JsonResponse(array(), 200, array());
        } else {
            return $this->redirect($this->generateUrl('organizer_index'));
        }

    }

    public function showOfflinePageAction() {
        return array();
    }
    /**
     * @Route("/services/get-offers")
     * @Method("GET")
     * @Template()
     */
    public function getServiceOffersAction(Request $request) {
//        $reqDate = $request->query->get('date');
//        if (isset($reqDate) && $reqDate != '' && $this->validateDate($reqDate)) {
//            $date = $reqDate;
//        } else {
//            $date = date('Y-m-d');
//        }
        $callback = $request->get('callback');
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('WOMainBundle:Offer')->getAllOffers();
        $result = array();
        /* @var /WOMainBundle/Entity/Offer $offer */
        foreach ($entities as $key => $offer) {
            $service = $offer->getService();
            $result[$key]['name'] = $service->getName();
            $result[$key]['description'] = $service->getDescription();
            $result[$key]['start'] = $offer->getOfferStart()->format('d.m.Y');
            $result[$key]['end'] = $offer->getOfferEnd()->format('d.m.Y');
            $result[$key]['oldPrice'] = $service->getPrice();
            $result[$key]['newPrice'] = $offer->getOfferPrice();
        }
//        return new JsonResponse(array('offers' => $result));
        $response = new JsonResponse($result, 200, array());
        $response->setCallback($callback);
        return $response;
    }

    /**
     * checks the date for valid format
     * @param string $date
     * @param string $format
     * @return bool
     */
    private function validateDate($date, $format = 'Y-m-d')
    {
        if ($date instanceof \DateTime) {
            $date = $date->format($format);
        } elseif (is_array($date) && isset($date['date'])) {
            $date = $date['date'];
        }
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
}
