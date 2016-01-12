<?php

namespace CarnetApp\ToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CarnetApp\ToolBundle\Entity\Option;
use CarnetApp\ToolBundle\Form\Type\OptionType;

/**
 * Option controller.
 *
 */
class OptionController extends Controller
{

    /**
     * Lists all Option entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CarnetAppToolBundle:Option')->findById(1);
        return $this->render('CarnetAppToolBundle:Option:index.html.twig', array(
            'toolOption' => current($entities),
        ));
    }
    /**
     * Displays a form to edit an existing Option entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetAppToolBundle:Option')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Option entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('CarnetAppToolBundle:Option:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        ));
    }

    /**
    * Creates a form to edit a Option entity.
    *
    * @param Option $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Option $entity)
    {
        $form = $this->createForm(new OptionType(), $entity, array(
            'action' => $this->generateUrl('admin_carnet_tool_option_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Option entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CarnetAppToolBundle:Option')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Option entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_carnet_tool_option_edit', array('id' => $id)));
        }

        return $this->render('CarnetAppToolBundle:Option:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

}
