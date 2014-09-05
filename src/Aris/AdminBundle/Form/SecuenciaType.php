<?php

namespace Aris\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SecuenciaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text', array('label' => 'Nombre:'))
            ->add('galeria')
            ->add('submit', 'submit', array('label' => 'Actualizar'));
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Aris\MainBundle\Entity\Secuencia'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'aris_mainbundle_secuencia';
    }
}
