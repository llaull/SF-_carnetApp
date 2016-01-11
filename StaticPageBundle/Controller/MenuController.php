<?php


namespace CarnetApp\StaticPageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function menuAction()
    {
        $em = $this->getDoctrine()->getManager();

        $links = $em->getRepository('CarnetAppStaticPageBundle:Texte')->findBy(
            array('useInMenu' => "1"),
            array('title' => 'ASC'));

        if (!$links) {
            throw $this->createNotFoundException('Unable to find Texte entity.');
        }

        return $this->container->get('templating')->renderResponse('CarnetAppStaticPageBundle:Default:menu.html.twig', array(
            'links' => $links
        ));
    }



    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function footerAction()
    {
        $em = $this->getDoctrine()->getManager();

        $links = $em->getRepository('CarnetAppStaticPageBundle:Texte')->findBy(
            array('useInMenu' => "1"),
            array('ordre' => 'ASC'));

        $footerTexte = $em->getRepository('CarnetAppStaticPageBundle:Texte')->findByTitle("footer");

        $tagLieu = $em->getRepository('CarnetAppCarnetBundle:Lieu')->tagAll();

        if (!$links) {
            throw $this->createNotFoundException('Unable to find Texte entity.');
        }

        if (!$footerTexte) {
            $footerTexte = array(array("contenu" => "footer à remplir"));
        }

        return $this->container->get('templating')->renderResponse('CarnetAppStaticPageBundle:Default:footer.html.twig', array(
            'links' => $links,
            'footerTexte' => current($footerTexte),
            'tag' => $tagLieu,

        ));
    }
}
