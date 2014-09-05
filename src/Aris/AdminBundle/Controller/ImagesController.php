<?php

namespace Aris\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Aris\MainBundle\Entity\Images;
use Aris\AdminBundle\Form\ImagesCollectionType;
use Aris\AdminBundle\Form\ImagesType;

/**
 * Images controller.
 *
 */
class ImagesController extends Controller
{

    /**
     * Lists all Images entities.
     *
     */
    public function indexAction($id) 
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ArisMainBundle:Galeria')->findOneBy(array('id'=>$id));

        return $this->render('ArisAdminBundle:Images:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Images entity.
     *
     */
    public function createAction(Request $request, $id) 
    {   $em = $this->getDoctrine()->getManager();
        $entity = new Images();
        $galeria = $em->getRepository('ArisMainBundle:Galeria')->findOneBy(array('id'=>$id));
        $entity->setGaleria($galeria);
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
           
          foreach ($form->get('image')->getData() as $image)  {
            $image->setGaleria($galeria);
            $em->persist($image);
            $em->flush();
          }
          
        
          $this->get('session')->getFlashBag()->add('notice', 'Imagenes creadas correctamente');
        
          return $this->redirect($this->generateUrl('images', array('id' => $id)));
        }

        return $this->render('ArisAdminBundle:Images:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Images entity.
     *
     * @param Images $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Images $entity) 
    {
        $form = $this->createForm(new ImagesCollectionType(), $entity, array(
            'action' => $this->generateUrl('images_create', array('id' => $entity->getGaleria()->getId())),
            'method' => 'POST',
        ));
        
        $form->add('submit', 'submit', array('label' => 'Añadir'));

        return $form;
    }

    /**
     * Displays a form to create a new Images entity.
     *
     */
    public function newAction($id) 
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Images();
        $galeria = $em->getRepository('ArisMainBundle:Galeria')->findOneBy(array('id'=>$id));
        $entity->setGaleria($galeria);
      
        $form   = $this->createCreateForm($entity);

        return $this->render('ArisAdminBundle:Images:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

   

    /**
     * Displays a form to edit an existing Images entity.
     *
     */
    public function editAction($id) 
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ArisMainBundle:Images')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Images entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('ArisAdminBundle:Images:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
          
        ));
    }

    /**
    * Creates a form to edit a Images entity.
    *
    * @param Images $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Images $entity) 
    {
        $form = $this->createForm(new ImagesType(), $entity, array(
            'action' => $this->generateUrl('images_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Images entity.
     *
     */
    public function updateAction(Request $request, $id) 
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ArisMainBundle:Images')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Images entity.');
        }
        
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
              $this->get('session')->getFlashBag()->add('notice', 'Imagen actualizada correctamente');
            return $this->redirect($this->generateUrl('images', array('id' => $entity->getGaleria()->getId() )));
        }

        return $this->render('ArisAdminBundle:Images:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
           
        ));
    }
    /**
     * Deletes a Images entity.
     *
     */
    public function deleteAction(Request $request, $id) 
    {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ArisMainBundle:Images')->find($id);
            $sec_id=$entity->getGaleria()->getId();
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Images entity.');
            }

            $em->remove($entity);
            $em->flush();
    
        $this->get('session')->getFlashBag()->add('notice', 'Imagen eliminada correctamente');
        return $this->redirect($this->generateUrl('images', array('id' => $sec_id)));
    }

   
}
