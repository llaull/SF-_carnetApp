<?php

namespace CarnetApp\CarnetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        //les lieux visites
        $lieux = $this->getDoctrine()
            ->getRepository('CarnetAppCarnetBundle:Lieu')
            ->allCoordonnee();

        //les carnets
        $carnets = $this->getDoctrine()
            ->getRepository('CarnetAppCarnetBundle:Carnet')
            ->findAllActived();

        return $this->render('CarnetAppCarnetBundle:Default:accueil.html.twig', array('carnets' => $carnets, 'lieux' => $lieux));
    }
}
