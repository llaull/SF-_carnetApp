<?php

namespace CarnetApp\CarnetBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LieuType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ville')
            ->add('useInPath', 'checkbox', array('required' => false, 'label' => 'afficher sur la carte'))
            ->add('carnet')
            ->add('dateArrived', 'date', array(
                    'widget' => 'single_text',
                    'input' => 'datetime',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'date'),
                )
            )
            ->add('dateDeparture', 'date', array(
                    'widget' => 'single_text',
                    'input' => 'datetime',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'date'),
                )
            )
            ->add('contenu', 'ckeditor', array(
                'label' => 'Contenu',
            ))
            ->add('useInMenu', 'checkbox', array('required' => false, 'label' => 'afficher dans le menu'))
            ->add('imageAccueil', 'elfinder', array(
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
            ))
            ->add('pinterestLink', 'text', array('required' => false))
            ->add('lat', null, array('read_only' => true))
            ->add('lng', null, array('read_only' => true)
            );
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CarnetApp\CarnetBundle\Entity\Lieu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'carnetapp_carnetbundle_lieu';
    }
}
