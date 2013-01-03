<?php

namespace Birrols\BeerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BeerController extends Controller
{
    public function showAction($id)
    {
        $beer = $this->getDoctrine()
                ->getRepository('BirrolsBeerBundle:Beer')->find($id);
        if (!$beer) {
            throw $this->createNotFoundException('No beer found for id '. $id);
        }
        
        return $this->render('BirrolsBeerBundle:Default:index.html.twig', array('id' => $id));
    }
    
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $beer = $em->getRepository('BirrolsBeerBundle:Beer')->find($id);
        if (!$beer) {
            throw $this->createNotFoundException('No beer found for id '. $id);
        }
        
        $beer->setName('laA');
        $em->flush();
        
        return $this->redirect($this->generateUrl('homepage'));
    }
            
}
