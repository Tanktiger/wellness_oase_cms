<?php

namespace WO\MainBundle\Controller;

use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use WO\MainBundle\Entity\ServiceCategory;
use WO\MainBundle\Form\ServiceCategoryType;

/**
 * ServiceCategory controller.
 *
 * @Route("/admin/servicecategory")
 */
class ServiceCategoryController extends Controller
{

    /**
     * Lists all ServiceCategory entities.
     *
     * @Route("/", name="admin_servicecategory")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('WOMainBundle:ServiceCategory')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new ServiceCategory entity.
     *
     * @Route("/", name="admin_servicecategory_create")
     * @Method("POST")
     * @Template("WOMainBundle:ServiceCategory:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new ServiceCategory();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_servicecategory_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a ServiceCategory entity.
     *
     * @param ServiceCategory $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ServiceCategory $entity)
    {
        $form = $this->createForm(new ServiceCategoryType(), $entity, array(
            'action' => $this->generateUrl('admin_servicecategory_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ServiceCategory entity.
     *
     * @Route("/new", name="admin_servicecategory_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ServiceCategory();
        $form   = $this->createCreateForm($entity);
        $em = $this->getDoctrine()->getManager();

        $count = $this->getCountOfAllCategories($em);
        $counts = range(1, $count);
        $form->add('position', 'choice', array('choice_list' => new ChoiceList($counts, $counts)));

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a ServiceCategory entity.
     *
     * @Route("/{id}", name="admin_servicecategory_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WOMainBundle:ServiceCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ServiceCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ServiceCategory entity.
     *
     * @Route("/{id}/edit", name="admin_servicecategory_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WOMainBundle:ServiceCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ServiceCategory entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        $count = $this->getCountOfAllCategories($em);
        $counts = range(0, $count - 1);
        $editForm->add('position', 'choice', array('choice_list' => new ChoiceList($counts, $counts)));

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a ServiceCategory entity.
    *
    * @param ServiceCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ServiceCategory $entity)
    {
        $form = $this->createForm(new ServiceCategoryType(), $entity, array(
            'action' => $this->generateUrl('admin_servicecategory_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ServiceCategory entity.
     *
     * @Route("/{id}", name="admin_servicecategory_update")
     * @Method("PUT")
     * @Template("WOMainBundle:ServiceCategory:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WOMainBundle:ServiceCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ServiceCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_servicecategory_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a ServiceCategory entity.
     *
     * @Route("/{id}", name="admin_servicecategory_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('WOMainBundle:ServiceCategory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ServiceCategory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_servicecategory'));
    }

    /**
     * Creates a form to delete a ServiceCategory entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_servicecategory_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    private function getCountOfAllCategories($em) {
        $qb = $em->createQueryBuilder();
        $qb->select('count(category.id)');
        $qb->from('WOMainBundle:ServiceCategory','category');

       return $qb->getQuery()->getSingleScalarResult();
    }
}
