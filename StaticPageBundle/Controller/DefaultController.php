<?php

namespace CarnetApp\StaticPageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CarnetAppStaticPageBundle:Default:index.html.twig', array('name' => $name));
    }
}
