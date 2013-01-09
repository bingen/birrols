<?php

namespace Birrols\BeerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Birrols\BeerBundle\Entity\BeerTypes;
use Birrols\BeerBundle\Form\BeerTypesType;

/**
 * BeerTypes controller.
 *
 */
class BeerTypesController extends Controller
{
    /**
     * Lists all BeerTypes entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BirrolsBeerBundle:BeerTypes')->findAll();

        return $this->render('BirrolsBeerBundle:BeerTypes:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a BeerTypes entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BirrolsBeerBundle:BeerTypes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BeerTypes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BirrolsBeerBundle:BeerTypes:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new BeerTypes entity.
     *
     */
    public function newAction()
    {
        $entity = new BeerTypes();
        $form   = $this->createForm(new BeerTypesType(), $entity);

        return $this->render('BirrolsBeerBundle:BeerTypes:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new BeerTypes entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new BeerTypes();
        $form = $this->createForm(new BeerTypesType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('beertypes_show', array('id' => $entity->getId())));
        }

        return $this->render('BirrolsBeerBundle:BeerTypes:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing BeerTypes entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BirrolsBeerBundle:BeerTypes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BeerTypes entity.');
        }

        $editForm = $this->createForm(new BeerTypesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BirrolsBeerBundle:BeerTypes:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing BeerTypes entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BirrolsBeerBundle:BeerTypes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BeerTypes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new BeerTypesType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('beertypes_edit', array('id' => $id)));
        }

        return $this->render('BirrolsBeerBundle:BeerTypes:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a BeerTypes entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BirrolsBeerBundle:BeerTypes')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find BeerTypes entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('beertypes'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
