<?php

namespace P2\Bundle\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use P2\Bundle\UserBundle\Entity\Administrator;
use P2\Bundle\UserBundle\Form\AdministratorType;
use P2\Bundle\RoleBundle\Entity\Role;
use P2\Bundle\GeneralBundle\Util\Util;

/**
 * Administrator controller.
 *
 */
class AdministratorController extends SuperController
{
    private $P2_ERR_CREATING_UPDATING = 'The were some errors and the administrator couldn\'t be %s';
    private $P2_SUCCESS_CRE_UPD_DEL = 'Administrator %s successfully';

    /**
     * Lists all Administrator entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('P2UserBundle:Administrator')->findAll();

        return $this->render('P2UserBundle:Administrator:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Administrator entity.
     *
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Administrator();
        
        //specific administrator's parameters -- important!
        //salt
        $salt = Util::getSalt();
        $entity->setSalt($salt);
        
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            //verifying that this user has the admin role
            $roleLabel = $this->ROLE_ADMIN;
            $roleEntity = $em->getRepository('P2RoleBundle:Role')->findOneByLabel($roleLabel);
            //if admin role doesn't exist, the creat it
            if (!$roleEntity) {
                $roleEntity = new Role();
                $roleEntity->setLabel($roleLabel)->setDescription($this->ROLE_ADMIN_DESCRIP)->setActive(true);
                $em->persist($roleEntity);
                $em->flush();
            }
            //check wether the user marked the admin role in the form or not, if not add it to the admin entity
            if(!$entity->hasRole($roleEntity))
            {
                $entity->addRole($roleEntity);
            }

            $em->persist($entity);
            $em->flush();
            $this->addFlash($this->P2_NOTICE_SUCCESS, sprintf($this->P2_SUCCESS_CRE_UPD_DEL, 'created'));

            return $this->redirect($this->generateUrl('administrator_show', array('id' => $entity->getId())));
        }
        $this->addFlash($this->P2_NOTICE_ERROR, sprintf($this->P2_ERR_CREATING_UPDATING, 'created'));

        return $this->render('P2UserBundle:Administrator:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Administrator entity.
     *
     * @param Administrator $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Administrator $entity)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new AdministratorType($em), $entity, array(
            'action' => $this->generateUrl('administrator_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));
        $form->add('submit2', 'submit', array('label' => 'Create'));    //another button for navegavility

        return $form;
    }

    /**
     * Displays a form to create a new Administrator entity.
     *
     */
    public function newAction()
    {
        $entity = new Administrator();
        $form   = $this->createCreateForm($entity);

        return $this->render('P2UserBundle:Administrator:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Administrator entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('P2UserBundle:Administrator')->find($id);

        if (!$entity) {
            return $this->render('P2UserBundle:Default:404.html.twig',
             array('message' => 'Sorry, we couldn\'t find that administrator'));//not found
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('P2UserBundle:Administrator:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Administrator entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('P2UserBundle:Administrator')->find($id);

        if (!$entity) {
            return $this->render('P2UserBundle:Default:404.html.twig',
             array('message' => 'Sorry, we couldn\'t find that administrator'));//not found
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('P2UserBundle:Administrator:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to delete an existing Administrator entity.
     *
     */
    public function showDeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('P2UserBundle:User')->find($id);

        if (!$entity) {
            return $this->render('P2UserBundle:Default:404.html.twig',
             array('message' => 'Sorry, we couldn\'t find that administrator'));//not found
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('P2UserBundle:Includes:delete.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Administrator entity.
    *
    * @param Administrator $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Administrator $entity)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new AdministratorType($em), $entity, array(
            'action' => $this->generateUrl('administrator_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));
        $form->add('submit2', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Administrator entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('P2UserBundle:Administrator')->find($id);

        if (!$entity) {
            return $this->render('P2UserBundle:Default:404.html.twig',
             array('message' => 'Sorry, we couldn\'t find that administrator'));//not found
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->addFlash($this->P2_NOTICE_SUCCESS, sprintf($this->P2_SUCCESS_CRE_UPD_DEL, 'modified'));

            return $this->redirect($this->generateUrl('administrator_edit', array('id' => $id)));
        }
        $this->addFlash($this->P2_NOTICE_ERROR, sprintf($this->P2_ERR_CREATING_UPDATING, 'modified'));

        return $this->render('P2UserBundle:Administrator:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Administrator entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        //FIXME -- re-activate the validation, find out why it's denying the reques from the modal
        //if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('P2UserBundle:Administrator')->find($id);

            if (!$entity) {
                return $this->render('P2UserBundle:Default:404.html.twig',
             array('message' => 'Sorry, we couldn\'t find that administrator'));//not found
            }

            $em->remove($entity);
            $em->flush();
        //}

        return $this->redirect($this->generateUrl('administrator'));
    }

    /**
     * Creates a form to delete a Administrator entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administrator_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
