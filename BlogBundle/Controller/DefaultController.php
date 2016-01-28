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

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entities,
            $this->get('request')->query->get('page', 1), 10
        );

        $seoPage = $this->container->get('sonata.seo.page');
        $seoPage
            ->setTitle("Le lounge - articles du blog " . $this->getParameter('app_titleSuffix'))
            ->addMeta('name', 'description', "Entre deux voyages, deux aventures, deux escales, nous livrons dans le Lounge des anecdotes, informations, billets d’humeur ou adresses coup de cœur que nous souhaitons partager avec vous !")
            ->addMeta('property', 'og:title', $seoPage->getTitle())
            ->addMeta('property', 'og:type', 'blog')
            ->addMeta('property', 'og:description', 'Entre deux voyages, deux aventures, deux escales, nous livrons dans le Lounge des anecdotes, informations, billets d’humeur ou adresses coup de cœur que nous souhaitons partager avec vous !');

        return $this->render('CarnetAppBlogBundle:Article:showAll.html.twig', array(
            'entities' => $pagination,
        ));
    }

}
