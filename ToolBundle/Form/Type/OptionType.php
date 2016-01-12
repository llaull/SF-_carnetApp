<?php

namespace CarnetApp\ToolBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OptionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('blogActived')
            ->add('blogCommentActived')
            ->add('siteActived')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CarnetApp\ToolBundle\Entity\Option'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'carnetapp_toolbundle_option';
    }
}
