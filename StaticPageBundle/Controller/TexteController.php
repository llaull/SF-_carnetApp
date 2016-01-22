<?php

namespace CarnetApp\StaticPageBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

use CarnetApp\StaticPageBundle\Entity\Texte;
use CarnetApp\StaticPageBundle\Form\Type\TexteType;

/**
 * Texte controller.
 *
 */
class TexteController extends Controller
{

    public function orderAction(Request $request)
    {

        $data = $request->request->get('data');
        $params = json_decode($data);
        $em = $this->getDoctrine()->getManager();

        //met tout a null
        $q = $em->createQuery('update CarnetAppStaticPageBundle:Texte c set c.ordre = 1');
        $q->execute();


        $em = $this->getDoctrine()->getManager();
        foreach ($params as $v) {

            $entity = $em->getRepository('CarnetAppStaticPageBundle:Texte')->find($v->id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Texte entity.');
            }

            $entity->setOrdre($v->order);
        }
        $em->flush();
        return new JsonResponse(array('result' => "ok"));

    }

    /**
     * Lists all Texte entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CarnetAppStaticPageBundle:Texte')->findAll();

        return $this->render('CarnetAppStaticPageBundle:Texte:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Texte entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Texte();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_carnet_staticPage_texte'));
        }

        return $this->render('CarnetAppStaticPageBundle:Texte:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Texte entity.
     *
     * @param Texte $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Texte $entity)
    {
        $form = $this->createForm(new TexteType(), $entity, array(
            'action' => $this->generateUrl('admin_carnet_staticPage_texte_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Texte entity.
     *
     */
    public function newAction()
    {
        $entity = new Texte();
        $form   = $this->createCreateForm($entity);

        return $this->render('CarnetAppStaticPageBundle:Texte:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Texte entity.
     *
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetAppStaticPageBundle:Texte')->findOneBySlug($slug);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Texte entity.');
        }

        return $this->render('CarnetAppStaticPageBundle:Texte:show.html.twig', array(
            'GeneralTexte' => $entity
        ));
    }

    /**
     * Displays a form to edit an existing Texte entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetAppStaticPageBundle:Texte')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Texte entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CarnetAppStaticPageBundle:Texte:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Texte entity.
    *
    * @param Texte $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Texte $entity)
    {
        $form = $this->createForm(new TexteType(), $entity, array(
            'action' => $this->generateUrl('admin_carnet_staticPage_texte_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Texte entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetAppStaticPageBundle:Texte')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Texte entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_carnet_staticPage_texte_edit', array('id' => $id)));
        }

        return $this->render('CarnetAppStaticPageBundle:Texte:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Texte entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetAppStaticPageBundle:Texte')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Texte entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_carnet_staticPage_texte'));
    }

    /**
     * Creates a form to delete a Texte entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_carnet_staticPage_texte_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
