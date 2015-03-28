<?php

namespace WO\OrganizerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use WO\OrganizerBundle\Services\TableHelper;

/**
 * Class DefaultController
 * @package WO\OrganizerBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * shows the Organizer index Page
     * @Route("/", name="organizer_index" )
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $reqDate = $request->query->get('date');
        if (isset($reqDate) && $reqDate != '' && $this->validateDate($reqDate)) {
            $date = $reqDate;
        } else {
            $date = date('Y-m-d');
        }
        //create Table
        $em = $this->getDoctrine()->getManager();
        $helper = new TableHelper($this->container->get('router') ,$em);
        $table = $helper->buildTableForDate($date);

        $employees = $em->getRepository('WOOrganizerBundle:Employee')->findAll();
        $worktimes = $em->getRepository('WOOrganizerBundle:Worktime')->findAllByDate($date);

        $date = new \DateTime($date);

        return array('table' => $table, 'date' => $date->format('d.m.Y'), 'employees' => $employees,
                    'worktimes' => $worktimes, 'db_date' => $date->format('Y-m-d'),
                    'date_year' => $date->format('Y'),
                    'date_day' => $date->format('d'),
                    'date_month' => $date->format('m'));
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
