<?php

namespace WO\OrganizerBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Validator\Constraints\False;
use WO\OrganizerBundle\Entity\Event;
use WO\OrganizerBundle\Form\EventType;
use WO\MainBundle\Services\ConfigHelper;

/**
 * Event controller.
 *
 * @Route("/event")
 */
class EventController extends Controller
{

    /**
     * Lists all Event entities.
     *
     * @Route("/", name="organizer_event")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        return $this->redirect($this->generateUrl('organizer_index'));
//        $em = $this->getDoctrine()->getManager();
//
//        $entities = $em->getRepository('WOOrganizerBundle:Event')->findAll();
//
//        return array(
//            'entities' => $entities,
//        );
    }
    /**
     * Creates a new Event entity.
     *
     * @Route("/", name="organizer_event_create")
     * @Method("POST")
     * @Template("WOOrganizerBundle:Event:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Event();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('organizer_index', array('date' => $entity->getDay()->format('Y-m-d'))));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Event entity.
     *
     * @param Event $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Event $entity)
    {
        $form = $this->createForm(new EventType(), $entity, array(
            'action' => $this->generateUrl('organizer_event_create'),
            'method' => 'POST',
        ));
//        $em = $this->getDoctrine()->getManager();
//        $defaultPayment = $em->find('WOOrganizerBundle:Paymentmethod',1);
//        $form->add('paymentmethod', null, array('label' => 'Bezahlmethode',
//            'data' => (isset($entity) && null !== ($entity->getPaymentmethod()))?$entity->getPaymentmethod():$defaultPayment));
        $form->add('submit', 'submit', array('label' => 'Speichern', 'attr' => array('class' => 'btn btn-primary pull-right')));
        return $form;
    }

    /**
     * Displays a form to create a new Event entity.
     *
     * @Route("/new", name="organizer_event_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction(Request $request)
    {
        $entity = new Event();
        if (null !== $request && null !== ($request->query->get('startdate'))) {
            $date = new \DateTime($request->query->get('startdate'));
            $end = new \DateTime($request->query->get('startdate'));
            $entity->setDateStart( $date);
            $end->add(new \DateInterval('PT30M'));
            $entity->setDateEnd($end);
            $entity->setDay($date);
            $user = $this->getUser();
            $entity->setUser($user);

            //Standard Ort für Sylke setzen
            if (null !== $request->query->get('location_id')) {
                $locId = $request->query->get('location_id');
                $em = $this->getDoctrine()->getManager();
                $loc = $em->find('WOOrganizerBundle:Location', $locId);
                if (isset($loc)) {
                    $entity->setLocation($loc);
                    if ($loc->getName() == \WO\OrganizerBundle\Entity\Location::DEFAULT_SYLKE) {
//                        $employee = $em->getRepository('WOOrganizerBundle:Employee')->findOneBy(array('name' => 'Sylke'));
                        $sylke = $em->find('WOOrganizerBundle:Employee', \WO\OrganizerBundle\Entity\Employee::SYLKE_ID);
                        $entity->setEmployee($sylke);
                    }

                }
            }
        }
        $form = $this->createCreateForm($entity);
        $services = $this->getAllServices();
//        $form->add('day', 'hidden', array('data' => isset($options['data']) ? $options['data']->getDay()->format('Y-m-d') : new \Datetime('now')));
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'services' => $services
        );
    }

    /**
     * Finds and displays a Event entity.
     *
     * @Route("/{id}", name="organizer_event_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WOOrganizerBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Event entity.
     *
     * @Route("/{id}/edit", name="organizer_event_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WOOrganizerBundle:Event')->find($id);

        if (!$entity) {
            return $this->redirect($this->generateUrl('organizer_event_new'));
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);
        $services = $this->getAllServices();
        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'services' => $services
        );
    }

    /**
    * Creates a form to edit a Event entity.
    *
    * @param Event $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Event $entity)
    {
        $form = $this->createForm(new EventType(), $entity, array(
            'action' => $this->generateUrl('organizer_event_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        $form->add('location', null, array('label' => 'Ort'));
        $form->add('submit', 'submit', array('label' => 'Speichern', 'attr' => array('class' => 'btn btn-primary pull-right')));
        return $form;
    }
    /**
     * Edits an existing Event entity.
     *
     * @Route("/{id}", name="organizer_event_update")
     * @Method("PUT")
     * @Template("WOOrganizerBundle:Event:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WOOrganizerBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('organizer_index', array('date' => $entity->getDay()->format('Y-m-d'))));
//            return $this->redirect($this->generateUrl('organizer_event_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Event entity.
     *
     * @Route("/{id}", name="organizer_event_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);
        $success = false;
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('WOOrganizerBundle:Event')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Event entity.');
            }

            $em->remove($entity);
            $em->flush();
            $success = true;
        }
        return new JsonResponse(array('success' => $success));
//        return $this->redirect($this->generateUrl('organizer_index'));
    }

    /**
     * Creates a form to delete a Event entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('organizer_event_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Löschen ', 'attr' => array('class' => 'btn btn-danger pull-right deleteEvent')))
            ->getForm()
        ;
    }

    /**
     * @Route("/check_form", name="organizer_event_check_form")
     * @Method("POST")
     * @Template()
     */
    public function checkFormAction(Request $request) {
        $success = false;
        $replacing = null;

        $em = $this->getDoctrine()->getManager();
        $config = $em->find('WOMainBundle:Config', 1);
//        $configHelper = new ConfigHelper(null, $em);
//        $config = $configHelper->get();
        if ($config->getEventOverwriteProtection() === false) {
            return new JsonResponse(array('success' => true, 'event' => $replacing));
        }
        $startMinute = $request->get('dateStartMinute');
        $startHour = $request->get('dateStartHour');
        $endMinute = $request->get('dateEndMinute');
        $endHour = $request->get('dateEndHour');
        $date = $request->get('date');
        $locId = $request->get('locationId');

        if ($this->checkIsset($endMinute)
            && $this->checkIsset($endHour)
            && $this->checkIsset($startMinute)
            && $this->checkIsset($startHour)
            && $this->checkIsset($date)
            && $this->checkIsset($locId)
        ) {
            $endTime = $date . ' ' . $endHour . ':' . $endMinute . ':00';
            $endTime = new \DateTime($endTime);


            $startTime = $date . ' ' . $startHour . ':' . $startMinute . ':00';
            $startTime = new \DateTime($startTime);

            //Hack damit man nicht startzeit des nächsten termines trifft
            $endTime->modify('-1 minute');
            $startTime->modify('+1 minute');


            $entities = $em->getRepository('WOOrganizerBundle:Event')->getAllBetweenStartAndEnd($startTime, $endTime, $locId);

            if ($entities->count() == 0) {
                $success = true;
            } else {
                //TODO: umbauen auf mehrere
                foreach ($entities as $event) {
                    $new = array();
//                    $new['customer'] = $event->getCustomer();
//                    $new['start'] = $event->getDateStart()->format('d.m.Y H:i');
//                    $new['end'] = $event->getDateEnd()->format('d.m.Y H:i');
//                    $new['info'] = $event->getInfo();
                    $deleteform = $this->createDeleteForm($event->getId());
                    $html = $this->renderView('WOOrganizerBundle:Event:overwrite.html.twig', array('delete_form' => $deleteform->createView(), 'event' => $event) );
                    $new['deleteForm'] = $html;
//                    $new['deleteUrl'] = $this->generateUrl('organizer_event_delete', array('id' => $event->getId()));
                    $replacing = $new;
                    break;
                }
            }
        }
        return new JsonResponse(array('success' => $success, 'event' => $replacing));
    }

    private function checkIsset($value) {
        return (isset($value) && $value != '');
    }

    private function getAllServices() {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('WOMainBundle:Service')->findAll();
        $result = array();
        foreach ($entities as $key => $service) {
            $result[] = $service->getName();
        }
        return $result;
    }
}
