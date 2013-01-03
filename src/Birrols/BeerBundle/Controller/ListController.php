<?php

namespace Birrols\BeerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListController extends Controller
{
    public function indexAction($page)
    {
        return $this->render('BirrolsBeerBundle:Default:index.html.twig', array('name' => $page));
    }
}
