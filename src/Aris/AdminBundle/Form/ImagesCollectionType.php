<?php

namespace Aris\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Braincrafted\Bundle\BootstrapBundle\Form\Type;

class ImagesCollectionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       
       
        $builder->add('image',
                    'bootstrap_collection',
                    array(
                        'allow_add'          => true,
                        'allow_delete'       => true,
                        'type'               => new ImagesType(),
                        'add_button_text'    => 'Añadir Imagenes',
                        'label'              => ' ',
                        'delete_button_text' => 'Eliminar Imagenes',
                        'sub_widget_col'     => 6,
                        'button_col'         => 6,
                        'by_reference' => false )
    			)
            ->getForm();
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Aris\MainBundle\Entity\Images'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'images';
    }
}
