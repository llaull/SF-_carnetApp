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
     * @param null $carnet
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function carnetMenuAction($carnet = null)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetAppBlogBundle:Carnet')
            ->findOneBy(array('slug' => $carnet));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carnet entity.');
        }

        $lieux = $em->getRepository('CarnetAppBlogBundle:Lieu')->findBy(
            array('carnet' => $entity, 'useInMenu' => "1"),
            array('ordre' => 'ASC'));

        $pages = $em->getRepository('CarnetAppBlogBundlev:Page')->findBy(
            array('lieu' => $lieux),
            array('ordre' => 'ASC'));

        return $this->container->get('templating')->renderResponse('CarnetAppStaticPageBundle:Carnet:menu.html.twig', array(
            'carnet' => $entity,
            'lieu' => $lieux,
            'page' => $pages,
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

        $tagLieu = $em->getRepository('CarnetAppBlogBundle:Lieu')->tagAll();

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
