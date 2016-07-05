<?php

namespace P2\Bundle\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('P2ProductBundle:Default:index.html.twig', array('name' => $name));
    }
}
