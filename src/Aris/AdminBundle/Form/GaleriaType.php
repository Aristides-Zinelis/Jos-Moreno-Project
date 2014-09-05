<?php

namespace Aris\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GaleriaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text', array('label' => 'Nombre:'))
            ->add('description', 'textarea', array('label' => 'Descripción:'))
            ->add('file', 'file', array('label' => 'Archivo:', 'required' => false));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Aris\MainBundle\Entity\Galeria'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'aris_mainbundle_galeria';
    }
}
