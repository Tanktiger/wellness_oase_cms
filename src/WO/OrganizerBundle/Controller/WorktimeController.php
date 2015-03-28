<?php

namespace WO\OrganizerBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use WO\OrganizerBundle\Entity\Worktime;
use WO\OrganizerBundle\Form\WorktimeType;

/**
 * Worktime controller.
 *
 * @Route("/worktime")
 */
class WorktimeController extends Controller
{

    /**
     * Lists all Worktime entities.
     *
     * @Route("/", name="organizer_worktime")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        return $this->redirect($this->generateUrl('organizer_index'));
    }
    /**
     * Creates a new Worktime entity.
     *
     * @Route("/", name="organizer_worktime_create")
     * @Method("POST")
     * @Template("WOOrganizerBundle:Worktime:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Worktime();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('organizer_index', array('date' => $entity->getDate()->format('Y-m-d'))));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Worktime entity.
     *
     * @param Worktime $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Worktime $entity)
    {
        $form = $this->createForm(new WorktimeType(), $entity, array(
            'action' => $this->generateUrl('organizer_worktime_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Speichern', 'attr' => array('class' => 'btn btn-primary pull-right')));
        return $form;
    }

    /**
     * Displays a form to create a new Worktime entity.
     *
     * @Route("/new", name="organizer_worktime_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction(Request $request)
    {
        $entity = new Worktime();
        if (null !== $request && null !== ($request->query->get('date'))) {
            $date = new \DateTime($request->query->get('date'));
            $entity->setDate($date);
            if (null !== ($request->query->get('employee'))) {
                $em = $this->getDoctrine()->getManager();
                $employee = $em->find('WOOrganizerBundle:Employee',$request->query->get('employee') );
                $entity->setEmployee($employee);
            }
        }
        $form   = $this->createCreateForm($entity);
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Worktime entity.
     *
     * @Route("/{id}", name="organizer_worktime_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WOOrganizerBundle:Worktime')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Worktime entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Worktime entity.
     *
     * @Route("/{id}/edit", name="organizer_worktime_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WOOrganizerBundle:Worktime')->find($id);

        if (!$entity) {
            return $this->redirect($this->generateUrl('organizer_worktime_new'));
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Worktime entity.
    *
    * @param Worktime $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Worktime $entity)
    {
        $form = $this->createForm(new WorktimeType(), $entity, array(
            'action' => $this->generateUrl('organizer_worktime_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Speichern', 'attr' => array('class' => 'btn btn-primary pull-right')));

        return $form;
    }
    /**
     * Edits an existing Worktime entity.
     *
     * @Route("/{id}", name="organizer_worktime_update")
     * @Method("PUT")
     * @Template("WOOrganizerBundle:Worktime:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WOOrganizerBundle:Worktime')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Worktime entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('organizer_index', array('date' => $entity->getDate()->format('Y-m-d'))));
//            return $this->redirect($this->generateUrl('organizer_worktime_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Worktime entity.
     *
     * @Route("/{id}", name="organizer_worktime_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);
        $success = false;
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('WOOrganizerBundle:Worktime')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Worktime entity.');
            }

            $em->remove($entity);
            $em->flush();
            $success = true;
        }
        return new JsonResponse(array('success' => $success));
//        return $this->redirect($this->generateUrl('organizer_worktime'));
    }

    /**
     * Creates a form to delete a Worktime entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('organizer_worktime_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Löschen ', 'attr' => array('class' => 'btn btn-danger pull-right deleteWorktime')))
            ->getForm()
        ;
    }
}
