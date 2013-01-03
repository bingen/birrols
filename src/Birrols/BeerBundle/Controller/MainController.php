<?php

namespace Birrols\BeerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// use Symfony\Component\HttpFoundation\Response;

/**
 * Description of MainController
 *
 * @author bingen
 */
class MainController extends Controller {

    public function indexAction() {
        return $this->render(
                '::base.html.twig',
                array( 'title_1' => 'CERVEZA', 
                    'title_2' => 'ARTESANA' )
                );
    }

}
?>