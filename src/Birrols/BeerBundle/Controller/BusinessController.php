<?php

namespace Birrols\BeerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Birrols\BeerBundle\Entity\Business;
use Birrols\BeerBundle\Form\BusinessType;

/**
 * Business controller.
 *
 */
class BusinessController extends Controller
{
    /**
     * Lists all Business entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BirrolsBeerBundle:Business')->findAll();
        
        $form = $this->createForm(new \Birrols\Beers\Form\BusinessSearchType());

        return $this->render('BirrolsBeerBundle:Business:index.html.twig', array(
            'entities' => $entities,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Business entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BirrolsBeerBundle:Business')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Business entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BirrolsBeerBundle:Business:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Business entity.
     *
     */
    public function newAction()
    {
        $entity = new Business();
        $form   = $this->createForm(new BusinessType(), $entity);

        return $this->render('BirrolsBeerBundle:Business:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Business entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Business();
        $form = $this->createForm(new BusinessType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('business_show', array('id' => $entity->getId())));
        }

        return $this->render('BirrolsBeerBundle:Business:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Business entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BirrolsBeerBundle:Business')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Business entity.');
        }

        $editForm = $this->createForm(new BusinessType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BirrolsBeerBundle:Business:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Business entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BirrolsBeerBundle:Business')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Business entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new BusinessType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('business_edit', array('id' => $id)));
        }

        return $this->render('BirrolsBeerBundle:Business:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Business entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BirrolsBeerBundle:Business')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Business entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('business'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
