<?php

namespace WO\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use WO\MainBundle\Entity\Notice;
use WO\MainBundle\Form\NoticeType;

/**
 * Notice controller.
 *
 * @Route("/admin/notice")
 */
class NoticeController extends Controller
{

    /**
     * Lists all Notice entities.
     *
     * @Route("/", name="admin_notice")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('WOMainBundle:Notice')->findBy(array(),array('createDate' => 'DESC'));
        $entity = new Notice();
        $user = $this->getUser();
        $entity->setUser($user);
        $form   = $this->createCreateForm($entity);
        $result = array();
        foreach ($entities as $key => $entity) {
            $result[$key]['entity'] = $entity;
            $result[$key]['deleteform'] = $this->createDeleteForm($entity->getId())->createView();
        }

        return array(
            'entities' => $result,
            'form'   => $form->createView(),
        );
    }
    /**
     * Creates a new Notice entity.
     *
     * @Route("/", name="admin_notice_create")
     * @Method("POST")
     * @Template("WOMainBundle:Notice:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Notice();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_notice'));
//            return $this->redirect($this->generateUrl('admin_notice_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Notice entity.
     *
     * @param Notice $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Notice $entity)
    {
        $form = $this->createForm(new NoticeType(), $entity, array(
            'action' => $this->generateUrl('admin_notice_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Speichern'));

        return $form;
    }

    /**
     * Displays a form to create a new Notice entity.
     *
     * @Route("/new", name="admin_notice_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Notice();
        $user = $this->getUser();
        $entity->setUser($user);
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Notice entity.
     *
     * @Route("/{id}", name="admin_notice_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WOMainBundle:Notice')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Notice entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Notice entity.
     *
     * @Route("/{id}/edit", name="admin_notice_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WOMainBundle:Notice')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Notice entity.');
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
    * Creates a form to edit a Notice entity.
    *
    * @param Notice $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Notice $entity)
    {
        $form = $this->createForm(new NoticeType(), $entity, array(
            'action' => $this->generateUrl('admin_notice_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Notice entity.
     *
     * @Route("/{id}", name="admin_notice_update")
     * @Method("PUT")
     * @Template("WOMainBundle:Notice:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WOMainBundle:Notice')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Notice entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_notice_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Notice entity.
     *
     * @Route("/{id}", name="admin_notice_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('WOMainBundle:Notice')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Notice entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_notice'));
    }

    /**
     * Creates a form to delete a Notice entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_notice_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Löschen'))
            ->getForm()
        ;
    }
}
