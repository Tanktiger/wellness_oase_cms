<?php

namespace WO\OrganizerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use WO\OrganizerBundle\Entity\Paymentmethod;
use WO\OrganizerBundle\Form\PaymentmethodType;

/**
 * Paymentmethod controller.
 *
 * @Route("/paymentmethod")
 */
class PaymentmethodController extends Controller
{

    /**
     * Lists all Paymentmethod entities.
     *
     * @Route("/", name="organizer_paymentmethod")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('WOOrganizerBundle:Paymentmethod')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Paymentmethod entity.
     *
     * @Route("/", name="organizer_paymentmethod_create")
     * @Method("POST")
     * @Template("WOOrganizerBundle:Paymentmethod:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Paymentmethod();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('paymentmethod_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Paymentmethod entity.
     *
     * @param Paymentmethod $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Paymentmethod $entity)
    {
        $form = $this->createForm(new PaymentmethodType(), $entity, array(
            'action' => $this->generateUrl('paymentmethod_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Paymentmethod entity.
     *
     * @Route("/new", name="organizer_paymentmethod_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Paymentmethod();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Paymentmethod entity.
     *
     * @Route("/{id}", name="organizer_paymentmethod_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WOOrganizerBundle:Paymentmethod')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paymentmethod entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Paymentmethod entity.
     *
     * @Route("/{id}/edit", name="organizer_paymentmethod_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WOOrganizerBundle:Paymentmethod')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paymentmethod entity.');
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
    * Creates a form to edit a Paymentmethod entity.
    *
    * @param Paymentmethod $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Paymentmethod $entity)
    {
        $form = $this->createForm(new PaymentmethodType(), $entity, array(
            'action' => $this->generateUrl('paymentmethod_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Paymentmethod entity.
     *
     * @Route("/{id}", name="organizer_paymentmethod_update")
     * @Method("PUT")
     * @Template("WOOrganizerBundle:Paymentmethod:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WOOrganizerBundle:Paymentmethod')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paymentmethod entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('paymentmethod_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Paymentmethod entity.
     *
     * @Route("/{id}", name="organizer_paymentmethod_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('WOOrganizerBundle:Paymentmethod')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Paymentmethod entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('paymentmethod'));
    }

    /**
     * Creates a form to delete a Paymentmethod entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('paymentmethod_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
