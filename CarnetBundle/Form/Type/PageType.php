<?php

namespace CarnetApp\CarnetBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
//            ->add('lieu')
        ;

        $builder->add('carnet', 'entity', array(
            'label' => 'carnet',
            'attr' => array('class' => 'input-block-level'),
            'class' => 'CarnetAppCarnetBundle:Carnet',
            'property' => 'title',
            'empty_value' => 'All',
            'required' => true,
        ));
        $builder->add('lieu', 'entity', array(
            'label' => 'lieu',
            'attr' => array('class' => 'input-block-level'),
            'class' => 'CarnetAppCarnetBundle:Lieu',
            'property' => 'ville',
            'empty_value' => 'All',
            'required' => true,
        ));

//        $builder->add('lieu', 'choice', array(
//            'choices' => array(
//                'selectionne un carnet' => null,
//            ),
////            'choices_as_values' => true,
////            'required' => true,
//        ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CarnetApp\CarnetBundle\Entity\Page'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'carnetapp_carnetbundle_page';
    }
}
