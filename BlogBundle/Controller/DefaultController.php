<?php

namespace CarnetApp\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexBlogAction()
    {

        $em = $this->getDoctrine()->getManager();
        $entities = $this->getDoctrine()->getRepository('CarnetAppBlogBundle:Article');
        $entities = $entities->findArticleWithInfo($em);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entities,
            $this->get('request')->query->get('page', 1),10
        );


        return $this->render('CarnetAppBlogBundle:Article:showAll.html.twig', array(
            'entities' => $pagination,
        ));
    }

}
