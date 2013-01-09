<?php

namespace Birrols\BeerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Birrols\BeerBundle\Entity\Beers;
use Birrols\BeerBundle\Form\BeersType;
use Birrols\BeerBundle\Form\BeersSearchType;

/**
 * Beers controller.
 *
 */
class BeersController extends Controller
{
    /**
     * Lists all Beers entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $paginator = $this->get('knp_paginator');
        $page = $this->get('request')->query->get('page', 1);
                
        $entities = $em->getRepository('BirrolsBeerBundle:Beers')
                ->findAllViewByPage( $paginator, $page, 10, array(
                    'categoryIds' => array( 1, 2 ),
                    'abvMin' => 4,
                ) );
        
        $form = $this->createForm(new BeersSearchType());

        return $this->render('BirrolsBeerBundle:Beers:index.html.twig', array(
            'entities' => $entities,
            'form' => $form->createView(),
//            'entities' => $entities->getItems(),
//            'entities' => compact('pagination'),
        ));
    }

    /**
     * Finds and displays a Beers entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BirrolsBeerBundle:Beers')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Beers entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BirrolsBeerBundle:Beers:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Beers entity.
     *
     */
    public function newAction()
    {
        $entity = new Beers();
        $form   = $this->createForm(new BeersType(), $entity);

        return $this->render('BirrolsBeerBundle:Beers:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Beers entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Beers();
        $form = $this->createForm(new BeersType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('beers_show', array('id' => $entity->getId())));
        }

        return $this->render('BirrolsBeerBundle:Beers:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Beers entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BirrolsBeerBundle:Beers')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Beers entity.');
        }

        $editForm = $this->createForm(new BeersType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BirrolsBeerBundle:Beers:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Beers entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BirrolsBeerBundle:Beers')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Beers entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new BeersType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('beers_edit', array('id' => $id)));
        }

        return $this->render('BirrolsBeerBundle:Beers:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Beers entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BirrolsBeerBundle:Beers')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Beers entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('beers'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
