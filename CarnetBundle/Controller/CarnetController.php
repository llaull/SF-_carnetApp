<?php

namespace CarnetApp\CarnetBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

use CarnetApp\CarnetBundle\Entity\Carnet;
use CarnetApp\CarnetBundle\Form\Type\CarnetType;

/**
 * Carnet controller.
 *
 */
class CarnetController extends Controller
{


    /**
     * @param null $carnet
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function carnetMenuAction($carnet = null)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetAppCarnetBundle:Carnet')
            ->findOneBy(array('slug' => $carnet));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carnet entity.');
        }

        $lieux = $em->getRepository('CarnetAppCarnetBundle:Lieu')->findBy(
            array('carnet' => $entity, 'useInMenu' => "1"),
            array('ordre' => 'ASC'));

        $pages = $em->getRepository('CarnetAppCarnetBundle:Page')->findBy(
            array('lieu' => $lieux),
            array('ordre' => 'ASC'));

        return $this->container->get('templating')->renderResponse('CarnetAppCarnetBundle:Carnet:menu.html.twig', array(
            'carnet' => $entity,
            'lieu' => $lieux,
            'page' => $pages,
        ));
    }

    /**
     * dessine le chemin du voyage
     *
     */
    public function pathAction($slug)
    {

        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CarnetAppCarnetBundle:Carnet')
            ->findOneBy(array('slug' => $slug));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carnet entity.');
        }

        $entities = $this->getDoctrine()->getRepository('CarnetAppCarnetBundle:Carnet');
        $entities = $entities->findPath($em, $entity->getId());

        return new JsonResponse(array('path' => $entities));
    }

    /**
     * Lists all Carnet entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CarnetAppCarnetBundle:Carnet')->findAll();

        return $this->render('CarnetAppCarnetBundle:Carnet:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Carnet entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Carnet();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_carnet'));
        }

        return $this->render('CarnetAppCarnetBundle:Carnet:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Carnet entity.
     *
     * @param Carnet $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Carnet $entity)
    {
        $form = $this->createForm(new CarnetType(), $entity, array(
            'action' => $this->generateUrl('admin_carnet_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Carnet entity.
     *
     */
    public function newAction()
    {
        $entity = new Carnet();
        $form = $this->createCreateForm($entity);

        return $this->render('CarnetAppCarnetBundle:Carnet:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Carnet entity.
     *
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetAppCarnetBundle:Carnet')
            ->findOneBy(array('slug' => $slug));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carnet entity.');
        }

        $lieux = $em->getRepository('CarnetAppCarnetBundle:Lieu')->findBy(
            array('carnet' => $entity->getId(), 'useInPath' => "1"),
            array('ordre' => 'ASC'));

        $seoPage = $this->container->get('sonata.seo.page');
        $seoPage
            ->setTitle($entity->getTitle() . ' ' . $this->getParameter('app_titleSuffix'))
            ->addMeta('name', 'description', $entity->getDescription())
            ->addMeta('property', 'og:title', $seoPage->getTitle())
            ->addMeta('property', 'og:type', 'blog')
            ->addMeta('property', 'og:description', $entity->getDescription());

        return $this->render('CarnetAppCarnetBundle:Carnet:show.html.twig', array(
            'entity' => $entity,
            'lieux' => $lieux
        ));
    }

    /**
     * Displays a form to edit an existing Carnet entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetAppCarnetBundle:Carnet')->find($id);

        $entitiesL = $em->getRepository('CarnetAppCarnetBundle:Lieu')->findBy(
            array('carnet' => $entity),
            array('ordre' => 'ASC'));

        $entitiesP = $em->getRepository('CarnetAppCarnetBundle:Page')->findBy(
            array('lieu' => $entitiesL),
            array('ordre' => 'ASC'));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carnet entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CarnetAppCarnetBundle:Carnet:edit.html.twig', array(
            'entity' => $entity,
            'lieux' => $entitiesL,
            'pages' => $entitiesP,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Carnet entity.
     *
     * @param Carnet $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Carnet $entity)
    {
        $form = $this->createForm(new CarnetType(), $entity, array(
            'action' => $this->generateUrl('admin_carnet_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Carnet entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetAppCarnetBundle:Carnet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carnet entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_carnet_edit', array('id' => $id)));
        }

        return $this->render('CarnetAppCarnetBundle:Carnet:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Carnet entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetAppCarnetBundle:Carnet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Texte entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_carnet'));
    }

    /**
     * Creates a form to delete a Carnet entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_carnet_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }
}
