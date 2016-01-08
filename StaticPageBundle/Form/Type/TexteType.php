<?php

namespace CarnetApp\StaticPageBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TexteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('created')
            ->add('modified')
            ->add('title')
            ->add('slug')
            ->add('contenu')
            ->add('useInMenu')
            ->add('ordre')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CarnetApp\StaticPageBundle\Entity\Texte'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'carnetapp_staticpagebundle_texte';
    }
}
