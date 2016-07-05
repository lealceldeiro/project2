<?php

namespace P2\Bundle\StoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use P2\Bundle\StoreBundle\Entity\Store;
use P2\Bundle\StoreBundle\Form\StoreType;

/**
 * Store controller.
 *
 */
class StoreController extends Controller
{
    private $P2_NOTICE_ERROR = 'notice_error';
    private $P2_NOTICE_SUCCESS = 'notice_success';
    private $P2_ERR_CREATING_UPDATING = 'The were some errors and the store couldn\'t be %s';
    private $P2_SUCCESS_CRE_UPD_DEL = 'Store %s successfully';

    /**
     * Lists all Store entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('P2StoreBundle:Store')->findAll();

        return $this->render('P2StoreBundle:Store:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Store entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Store();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->addFlash($this->P2_NOTICE_SUCCESS, sprintf($this->P2_SUCCESS_CRE_UPD_DEL, 'created'));

            return $this->redirect($this->generateUrl('store_show', array('id' => $entity->getId())));
        }
        $this->addFlash($this->P2_NOTICE_ERROR, sprintf($this->P2_ERR_CREATING_UPDATING, 'created'));

        return $this->render('P2StoreBundle:Store:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Store entity.
     *
     * @param Store $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Store $entity)
    {
        $form = $this->createForm(new StoreType(), $entity, array(
            'action' => $this->generateUrl('store_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Store entity.
     *
     */
    public function newAction()
    {
        $entity = new Store();
        $form   = $this->createCreateForm($entity);

        return $this->render('P2StoreBundle:Store:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Store entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('P2StoreBundle:Store')->find($id);

        if (!$entity) {
            return $this->render('P2StoreBundle:Default:404.html.twig',
             array('message' => 'Sorry, we couldn\'t find that store'));//not found
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('P2StoreBundle:Store:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Store entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('P2StoreBundle:Store')->find($id);

        if (!$entity) {
            return $this->render('P2StoreBundle:Default:404.html.twig',
             array('message' => 'Sorry, we couldn\'t find that store'));//not found
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('P2StoreBundle:Store:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to delete an existing Store entity.
     *
     */
    public function showDeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('P2StoreBundle:Store')->find($id);

        if (!$entity) {
            return $this->render('P2StoreBundle:Default:404.html.twig',
             array('message' => 'Sorry, we couldn\'t find that store'));//not found
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('P2StoreBundle:Store:delete.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Store entity.
    *
    * @param Store $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Store $entity)
    {
        $form = $this->createForm(new StoreType(), $entity, array(
            'action' => $this->generateUrl('store_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Store entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('P2StoreBundle:Store')->find($id);

        if (!$entity) {
            return $this->render('P2StoreBundle:Default:404.html.twig',
             array('message' => 'Sorry, we couldn\'t find that store'));//not found
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->addFlash($this->P2_NOTICE_SUCCESS, sprintf($this->P2_SUCCESS_CRE_UPD_DEL, 'modified'));

            return $this->redirect($this->generateUrl('store_edit', array('id' => $id)));
        }
        $this->addFlash($this->P2_NOTICE_ERROR, sprintf($this->P2_ERR_CREATING_UPDATING, 'modified'));

        return $this->render('P2StoreBundle:Store:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Store entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);
        //FIXME -- re-activate the validation, find out why it's denying the reques from the modal
        //if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('P2StoreBundle:Store')->find($id);

            if (!$entity) {
                return $this->render('P2StoreBundle:Default:404.html.twig',
             array('message' => 'Sorry, we couldn\'t find that store'));//not found
            }

            $em->remove($entity);
            $em->flush();
        //}

        return $this->redirect($this->generateUrl('store'));
    }

    /**
     * Creates a form to delete a Store entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('store_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
