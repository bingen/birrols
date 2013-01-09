<?php

namespace Birrols\BeerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Birrols\BeerBundle\Entity\BeerCategories;
use Birrols\BeerBundle\Form\BeerCategoriesType;

/**
 * BeerCategories controller.
 *
 */
class BeerCategoriesController extends Controller
{
    /**
     * Lists all BeerCategories entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BirrolsBeerBundle:BeerCategories')->findAll();

        return $this->render('BirrolsBeerBundle:BeerCategories:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a BeerCategories entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BirrolsBeerBundle:BeerCategories')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BeerCategories entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BirrolsBeerBundle:BeerCategories:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new BeerCategories entity.
     *
     */
    public function newAction()
    {
        $entity = new BeerCategories();
        $form   = $this->createForm(new BeerCategoriesType(), $entity);

        return $this->render('BirrolsBeerBundle:BeerCategories:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new BeerCategories entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new BeerCategories();
        $form = $this->createForm(new BeerCategoriesType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('beercategories_show', array('id' => $entity->getId())));
        }

        return $this->render('BirrolsBeerBundle:BeerCategories:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing BeerCategories entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BirrolsBeerBundle:BeerCategories')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BeerCategories entity.');
        }

        $editForm = $this->createForm(new BeerCategoriesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BirrolsBeerBundle:BeerCategories:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing BeerCategories entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BirrolsBeerBundle:BeerCategories')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BeerCategories entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new BeerCategoriesType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('beercategories_edit', array('id' => $id)));
        }

        return $this->render('BirrolsBeerBundle:BeerCategories:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a BeerCategories entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BirrolsBeerBundle:BeerCategories')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find BeerCategories entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('beercategories'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
