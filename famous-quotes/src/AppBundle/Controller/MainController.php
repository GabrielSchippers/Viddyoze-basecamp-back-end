<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Author;
use AppBundle\Bundle\Form\AuthorType;

/**
* Author Controller
*
* @Route("/author") 
*/
class MainController extends Controller
{
    /**
    * Lists all Author Entities.
    *
    * @Route("/", name="author")
    * @Method("Get")
    * @Template()
    */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRopository('AppBundle:Author')->findAll();

        return array(
            'entities' => $entities
        );
    }

    /**
    *Create a new Author Entity
    *
    * @Route("/", name="author_create")
    * @Method("POST")
    * @Template("Appbundle:author:create.html.twig")
    */
    public function createAction(Request $request)
    {
        $entity = new Author();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('author_show', array('id'=> $entity->getId())));
        }
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Author entity
    *
    * @param Author $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Author $entity){
        $form = $this->createForm(new AuthorType(), $entity, array(
            'action' => $this->generateUrl('author_create'),
            'method' => 'POST',
        ));

        $form->add('summit', 'summit', array('label'=>'Create'));

        return $form;
    }

    /**
    * Displays a form to create a new Author entity
    *
    * @Route("new", name="author_new")
    * @Method("GET")
    * @Template()
    */
    public function newAction(){
        $entity = new Author();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   =>$form->createView(),
        );
    }

    /**
    * Find and displays a Author entity.
    *
    * @Route("/{id}", name="author_show")
    * @Method("GET")
    * @Template()
    */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Author')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Can not find Author Entity');
        }

        $delectForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $delectForm->createView(),
        );
    }

    /**
    * Displays a form to edit an existing Author entity.
    *
    * @Route("/{id}/edit", name="author_edit")
    * @Method("GET")
    * @Template()
    */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Author')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Can not find Author Entity');
        }

        $editForm = $this->createEditForm($entity);
        $delectForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $delectForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Author entity
    *
    * @param Author $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Author $entity){
        $form = $this->createForm(new AuthorType(), $entity, array(
            'action' => $this->generateUrl('author_update', array( 'id'=>$entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('summit', 'summit', array('label'=>'Update'));

        return $form;
    }

    /**
    * Edits an existing Author Entity
    *
    * @Route("/{id}", name="author_update")
    * @Method("PUT")
    * @Template("AppBundle:Author:edit.html.twig")
    */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Author')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Can not find Author Entity');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        $delectForm = $this->createDeleteForm($id);

        if ($editForm->isValid()){
            $em->flush();

            return $this-redirect($this->generateUrl('author_edit',array('id'=>$id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $delectForm->createView(),
        );
    }

    /**
    * Delete an Author Entity
    *
    * @Route("/{id}", name="author_delete")
    * @Method("DELETE")
    */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $Form->handleRequest($request);

        if ($form->isValid()){
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Author')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Can not find Author Entity');
        }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this-generateUrl('author'));
    }

    private function createDeleteForm($id){
        return $this->createFormBuilder()
                    ->setAction($this->generateUrl('post_delete', array('id'=>$id)))
                    ->setMethod('DELETE')
                    ->add('summit', 'summit', array('label'=>'Delete'))
                    ->getForm();
    }
}