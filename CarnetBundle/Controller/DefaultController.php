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

    public function indexBlogAction()
    {

        $em = $this->getDoctrine()->getManager();
        $entities = $this->getDoctrine()->getRepository('CarnetAppCarnetBundle:BlogArticle');
        $entities = $entities->findArticleWithInfo($em);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entities,
            $this->get('request')->query->get('page', 1),10
        );


        return $this->render('CarnetAppCarnetBundle:BlogArticle:showAll.html.twig', array(
            'entities' => $pagination,
        ));
    }
}
