<?php

namespace WO\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use WO\MainBundle\Entity\Config;
use WO\MainBundle\Form\ConfigType;

/**
 * Config controller.
 *
 * @Route("/admin/config")
 */
class ConfigController extends Controller
{

    /**
     * Lists all Config entities.
     *
     * @Route("/", name="admin_config")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('WOMainBundle:Config')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Config entity.
     *
     * @Route("/", name="admin_config_create")
     * @Method("POST")
     * @Template("WOMainBundle:Config:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Config();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_config_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Config entity.
     *
     * @param Config $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Config $entity)
    {
        $form = $this->createForm(new ConfigType(), $entity, array(
            'action' => $this->generateUrl('admin_config_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Config entity.
     *
     * @Route("/new", name="admin_config_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Config();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Config entity.
     *
     * @Route("/{id}", name="admin_config_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WOMainBundle:Config')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Config entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Config entity.
     *
     * @Route("/{id}/edit", name="admin_config_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WOMainBundle:Config')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Config entity.');
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
    * Creates a form to edit a Config entity.
    *
    * @param Config $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Config $entity)
    {
        $form = $this->createForm(new ConfigType(), $entity, array(
            'action' => $this->generateUrl('admin_config_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Config entity.
     *
     * @Route("/{id}", name="admin_config_update")
     * @Method("PUT")
     * @Template("WOMainBundle:Config:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WOMainBundle:Config')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Config entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_config_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Config entity.
     *
     * @Route("/{id}", name="admin_config_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('WOMainBundle:Config')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Config entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_config'));
    }

    /**
     * Creates a form to delete a Config entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_config_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
