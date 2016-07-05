<?php

namespace P2\Bundle\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexBackendAction()
    {
        return $this->render('P2GeneralBundle:Default:indexBackend.html.twig');
    }
}
