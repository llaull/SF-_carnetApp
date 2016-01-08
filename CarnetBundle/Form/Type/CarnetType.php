<?php

namespace CarnetApp\CarnetBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CarnetType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('destination', 'text', array('required' => true));

        $builder->add('depart', 'date', array(
            'widget' => 'single_text',
            'input' => 'datetime',
            'format' => 'dd/MM/yyyy',
            'required' => true,
            'attr' => array('class' => 'date')
        ));

        $builder
            ->add('contenu', 'ckeditor', array(
                'label' => 'Contenu',
            ));


        $builder->add('imageAccueil', 'elfinder', array(
            'instance' => 'form',
            'label' => 'image de l\'accueil',
            'required' => false,
            'attr' => array('class' => 'form-control')
        ))
            ->add('imageHeader', 'elfinder', array(
                'instance' => 'form',
                'label' => 'header du carnet',
                'required' => false,
                'attr' => array('class' => 'form-control')
            ));


        $builder
            ->add('actived', 'checkbox', array(
                'required' => false,
                'label' => 'Afficher dans l\'accueil'
            ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CarnetApp\CarnetBundle\Entity\Carnet'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'carnetapp_carnetbundle_carnet';
    }
}
