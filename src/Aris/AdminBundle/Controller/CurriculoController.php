<?php

namespace Aris\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Aris\MainBundle\Entity\Curriculo;
use Aris\AdminBundle\Form\CurriculoType;

/**
 * curriculo controller.
 *
 */
class CurriculoController extends Controller
{

    /**
     * Lists all curriculo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ArisMainBundle:Curriculo')->findOneById(1);

        return $this->render('ArisAdminBundle:Curriculo:index.html.twig', array(
            'entity' => $entity,
        ));
    }
    /**
     * Creates a new curriculo entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new curriculo();
        $entity->setId(1);
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
       
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
        $this->get('session')->getFlashBag()->add('notice', 'Curriculo creado correctamente');     
            return $this->redirect($this->generateUrl('curriculo'));
        }

        return $this->render('ArisAdminBundle:Curriculo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a curriculo entity.
     *
     * @param curriculo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(curriculo $entity)
    {
        $form = $this->createForm(new curriculoType(), $entity, array(
            'action' => $this->generateUrl('curriculo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new curriculo entity.
     *
     */
    public function newAction()
    {
        $entity = new curriculo();
        $form   = $this->createCreateForm($entity);

        return $this->render('ArisAdminBundle:Curriculo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a curriculo entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ArisMainBundle:Curriculo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find curriculo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ArisMainBundle:Curriculo:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing curriculo entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ArisMainBundle:Curriculo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find curriculo entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ArisAdminBundle:Curriculo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a curriculo entity.
    *
    * @param curriculo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(curriculo $entity)
    {
        $form = $this->createForm(new curriculoType(), $entity, array(
            'action' => $this->generateUrl('curriculo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing curriculo entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ArisMainBundle:Curriculo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find curriculo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
          $this->get('session')->getFlashBag()->add('notice', 'Curriculo editado correctamente');       
            return $this->redirect($this->generateUrl('curriculo'));
        }

        return $this->render('ArisAdminBundle:Curriculo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a curriculo entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ArisMainBundle:curriculo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find curriculo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('curriculo'));
    }

    /**
     * Creates a form to delete a curriculo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('curriculo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
