<?php

namespace Aris\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

use Aris\MainBundle\Entity\Galeria;
use Aris\AdminBundle\Form\GaleriaType;

/**
 * Galeria controller.
 *
 */
class GaleriaController extends Controller
{

    /**
     * Lists all Galeria entities.
     *
     */
    public function indexAction() 
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ArisMainBundle:Galeria')->findAll();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $entities,
        $this->get('request')->query->get('page', 1)/*page number*/,
        8/*limit per page*/
                );
        

        return $this->render('ArisAdminBundle:Galeria:index.html.twig', array(
             'pagination'=>$pagination,
        ));
    }
    /**
     * Creates a new Galeria entity.
     *
     */
    public function createAction(Request $request) 
    {
        $entity = new Galeria();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
           
            $em->persist($entity);
            $em->flush();
          
                
                 
           
            $this->get('session')->getFlashBag()->add('notice', 'Galeria creada correctamente');
            return $this->redirect($this->generateUrl('galeria', array('id' => $entity->getId())));
        }

        return $this->render('ArisAdminBundle:Galeria:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Galeria entity.
     *
     * @param Galeria $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Galeria $entity) 
    {
        $form = $this->createForm(new GaleriaType(), $entity, array(
            'action' => $this->generateUrl('galeria_create'),
            'method' => 'POST',
        ));
        
         $form->add('submit', 'submit', array('label' => 'Añadir'));

       

        return $form;
    }

    /**
     * Displays a form to create a new Galeria entity.
     *
     */
    public function newAction() 
    {
        $entity = new Galeria();
        $form   = $this->createCreateForm($entity);
        

        return $this->render('ArisAdminBundle:Galeria:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Galeria entity.
     *
     */
    public function editAction($id) 
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ArisMainBundle:Galeria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Galeria entity.');
        }

        $editForm = $this->createEditForm($entity);
      

        return $this->render('ArisAdminBundle:Galeria:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
           
        ));
    }

    /**
    * Creates a form to edit a Galeria entity.
    *
    * @param Galeria $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Galeria $entity) 
    {
        $form = $this->createForm(new GaleriaType(), $entity, array(
            'action' => $this->generateUrl('galeria_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }
    /**
     * Edits an existing Galeria entity.
     *
     */
    public function updateAction(Request $request, $id) 
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ArisMainBundle:Galeria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Galeria entity.');
        }
      
      
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
             $this->get('session')->getFlashBag()->add('notice', 'Galeria actualizada correctamente');
            return $this->redirect($this->generateUrl('galeria'));
        }

        return $this->render('ArisAdminBundle:Galeria:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
           
        ));
    }
    /**
     * Deletes a Galeria entity.
     *
     */
    public function deleteAction(Request $request, $id) 
    {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ArisMainBundle:Galeria')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Galeria entity.');
            }

            $em->remove($entity);
            $em->flush();
      
            $this->get('session')->getFlashBag()->add('notice', 'Galeria eliminada correctamente');
        return $this->redirect($this->generateUrl('galeria'));
    }

   
 
}
