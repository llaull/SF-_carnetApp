<?php

namespace CarnetApp\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CarnetApp\BlogBundle\Entity\Article;
use CarnetApp\BlogBundle\Form\Type\ArticleType;

/**
 * Article controller.
 *
 */
class ArticleController extends Controller
{

    /**
     * Lists all Article entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CarnetAppBlogBundle:Article')->findAll();

        return $this->render('CarnetAppBlogBundle:Article:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Article entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Article();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_carnet_blog_article'));
        }

        return $this->render('CarnetAppBlogBundle:Article:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Article entity.
     *
     * @param Article $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Article $entity)
    {
        $form = $this->createForm(new ArticleType(), $entity, array(
            'action' => $this->generateUrl('admin_carnet_blog_article_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Article entity.
     *
     */
    public function newAction()
    {
        $entity = new Article();
        $form   = $this->createCreateForm($entity);

        return $this->render('CarnetAppBlogBundle:Article:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Article entity.
     *
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetAppBlogBundle:Article')->findBySlug($slug);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $entities = $this->getDoctrine()->getRepository('CarnetAppBlogBundle:Article');
        $category = $entities->findCategoyWithInfo($em);


        $tool = $em->getRepository('CarnetAppToolBundle:Option')->findById(1);


        $comment = $em->getRepository('CarnetAppBlogBundle:Comment')->findByArcticle($entity);
        $url = $this->generateUrl('carnets_de_voy_blog_article', array('slug' => $entity[0]->getSlug()), true);
        $seoPage = $this->container->get('sonata.seo.page');
        $seoPage
            ->setTitle($entity[0]->getTitle() .' - le lounge '.  $this->getParameter('app_titleSuffix'))
            ->addMeta('property', 'og:title', $seoPage->getTitle())
            ->addMeta('property', 'og:type', 'blog')
            ->addMeta('property', 'og:image', $url.'/../../..'.$entity[0]->getImage())
            ->addMeta('property', 'og:url', $url);


        return $this->render('CarnetAppBlogBundle:Article:show.html.twig', array(
            'article' => current($entity),
            'category' => $category,
            'comment' => $comment,
            'toolOption' => current($tool)

        ));
    }

    /**
     * Displays a form to edit an existing Article entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetAppBlogBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CarnetAppBlogBundle:Article:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Article entity.
    *
    * @param Article $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Article $entity)
    {
        $form = $this->createForm(new ArticleType(), $entity, array(
            'action' => $this->generateUrl('admin_carnet_blog_article_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Article entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetAppBlogBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_carnet_blog_article_edit', array('id' => $id)));
        }

        return $this->render('CarnetAppBlogBundle:Article:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Article entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetAppBlogBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_carnet_blog_article'));
    }


    /**
     * Creates a form to delete a Article entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_carnet_blog_article_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
