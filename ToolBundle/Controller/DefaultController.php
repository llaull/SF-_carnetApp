<?php

namespace CarnetApp\ToolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CarnetAppToolBundle:Default:index.html.twig', array('name' => $name));
    }
}
