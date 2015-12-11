<?php
namespace WO\OrganizerBundle\Services;
use \Doctrine\ORM\EntityManager;
use WO\OrganizerBundle\Entity\Event;

/**
 * Creates the event table
 * Class TableHelper
 * @package WO\OrganizerBundle\Services
 */
class TableHelper {
    private $em;
    private $router;

    public function __construct ($router, EntityManager $entityManager) {
        $this->em = $entityManager;
        $this->router = $router;
    }

    /**
     * Returns the full html for the table
     * @param string $date
     * @return string
     */
    public function buildTableForDate($date) {
        $locations = $this->em->getRepository('WOOrganizerBundle:Location')->findAll();
        $events = $this->em->getRepository('WOOrganizerBundle:Event')->findByDate($date);
        $worktimes = $this->em->getRepository('WOOrganizerBundle:Worktime')->findBy(array('date' => new \DateTime($date)));

        $period = $this->getTimePeriod($date." 08:00:00",$date." 20:00:00");
        $results = $locationArr = $tableHeaders = array();
        //create arrays are needed for table creation
        foreach ($locations as $location) {
            $locationArr[$location->getId()] = null;
            $tableHeaders[$location->getId()] = $location->getName();
        }
        //merge for every half hour all locations for table creation
        foreach($period as $dt){
            $results[$dt->format("Y-m-d H:i:s")] = $locationArr;
        }
        //merge all existing events in the result array
        foreach($events as $event) {
            $results[$event->getDateStart()->format('Y-m-d H:i:s')][$event->getLocation()->getId()] = $event;
        }

        $html = '<div class="table-responsive">
                  <table id="organizer" class="table table-bordered">
                    <thead><th class="low-width">&nbsp;</th>';
        $thWidth = 100 / count($tableHeaders);
        //set table headers
        foreach ($tableHeaders as $locationId => $header) {
            $html .= '<th style="width:'.$thWidth.'%;">'.$header.'</th>';
        }
        $html .= '<th class="low-width">&nbsp;</th>';
        $html .= '</thead><tbody>';
        $rowSpanTDs = array();
        //Table creation
        foreach ($results as $time => $locs) {
            $timevalue = \DateTime::createFromFormat('Y-m-d H:i:s', $time);
            //fill first cell with time
            $html .= '<tr data-time="'.$timevalue->format('Y-m-d H:i:s').'">
                        <td>' . $timevalue->format('H:i') . '</td>';
            foreach($tableHeaders as $locationId => $header) {
                //if previous event need more cells - we dont need to create one
                if (isset($rowSpanTDs[$locationId]) && $rowSpanTDs[$locationId] > 1) {
                    $rowSpanTDs[$locationId] = $rowSpanTDs[$locationId] - 1;
                    continue;
                }
                //if event exists - show it
                if (isset($locs[$locationId])) {
                    $event = $locs[$locationId];

                    //calculate difference between start and end date
                    $startDate = $event->getDateStart();
                    $endDate = $event->getDateEnd();
                    $diff = $startDate->diff($endDate);
                    $hours = ($diff->h * 2);
                    //if event is longer than half an hour we need to set rowspan
                    if ($hours > 0) {
                        if ($diff->i * 2 >= 60) {
                            $hours = $hours +1;
                        }
                        $rowSpanTDs[$locationId] = $hours;

                    }

                    $color = Event::NON_ASSIGNED_COLOR;
                    $employee = $event->getEmployee();
                    //if event has an employee - get the color
                    if (isset($employee)) {
                        $color = $employee->getColor();
                    }

                    $url = $this->router->generate('organizer_event_edit', array('id' => $event->getId()));
                    $canceled = '';
                    //if event is canceled, set the canceled class
                    if ($event->getCanceled()) {
                        $canceled = ' canceled ';
                    }
                    $html .= '<td data-location-id="'.$locationId.'" data-href="'.$url.'" class="organizer-editable-cell '.$canceled.'" rowspan="'.$hours.'" style="background-color:'.$color.'">';
                    $html .= $event->getCustomer();

                    $price = $event->getPrice();
                    if (isset($price)) {
                        $html .= ' - ' . $price . '&nbsp;&euro;';
                    }
                    $paymentMethod = $event->getPaymentmethod();
                    if (isset($paymentMethod)) {
                        $html .= ' - ' . $paymentMethod->getName();
                    }
                    $info = $event->getInfo();
                    if (isset($info)) {
                        $html .= '<br>'.$info;
                    }
                    $extrainfo = $event->getExtrainfo();
                    if (isset($extrainfo) && $extrainfo != '') {
                        $html .= '&nbsp;<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>';
                    }
                    if ($event->isPinned()) {
                        $html .= '&nbsp;<span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span>';
                    }
                    $html .= '</td>';
                } else {
                    //create clickable cell for event creation
                    $url = $this->router->generate('organizer_event_new');
                    $html .= '<td data-location-id="'.$locationId.'" data-href="'.$url.'" class="organizer-editable-cell">&nbsp;</td>';
                }
            }
            $html .= '<td>' . $timevalue->format('H:i') . '</td>';
            $html .= '</tr>';
        }

        $html .= '    </tbody>
                    </table>
                </div>';

        return $html;
    }

    /**
     * get Dateperiod between start and enddate
     * @param \DateTime $start
     * @param \DateTime $end
     * @param string $interval
     * @return \DatePeriod
     */
    public function getTimePeriod($start, $end, $interval = "PT30M") {
        $start = new \DateTime($start);
        $end = new \DateTime($end);
        $interval = new \DateInterval($interval);
        return new \DatePeriod($start,$interval,$end);
    }
}