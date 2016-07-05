<?php

namespace P2\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * Lists all instances of User entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('P2UserBundle:Administrator')->findAll();
        //FIXME -- there is still need of retrieving information regarding to
        // other user entities such 'customer', etc. and adding them to $entities collection

        return $this->render('P2UserBundle:Default:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Returns a json with all the address that contains a specific term in one of its attributes
     *
     */
    public function autocompleteAction(Request $request)
    {
        $addresses = array();
        $term = trim(strip_tags($request->get('term')));

        $em = $this->getDoctrine()->getManager();
        
        $entities = $em->getRepository('P2UserBundle:Address')->findAddressessWithThis($term);

        foreach ($entities as $entity)
        {
             $addresses[] = $entity->__toString();
        }

        $response = new JsonResponse();
        
        $response->setData($addresses);

        return $response;
        
    }
}
