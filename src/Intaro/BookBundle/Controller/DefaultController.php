<?php

namespace Intaro\BookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('IntaroBookBundle:Default:index.html.twig', array('name' => $name));
    }
}
