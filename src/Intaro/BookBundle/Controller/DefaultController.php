<?php

namespace Intaro\BookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * DefaultController class.
 * 
 * @extends Controller
 */
class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('IntaroBookBundle:Default:index.html.twig');
    }
}
