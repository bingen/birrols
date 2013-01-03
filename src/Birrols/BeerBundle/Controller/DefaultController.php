<?php

namespace Birrols\BeerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BirrolsBeerBundle:Default:index.html.twig', array('name' => $name));
    }
}
