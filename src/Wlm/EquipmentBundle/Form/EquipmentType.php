<?php

namespace Wlm\EquipmentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EquipmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	
        $builder
            ->add('size','text')
            ->add('code','text')
        ;
    	

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Wlm\EquipmentBundle\Entity\Equipment'
                ));
    }

    public function getName()
    {
        return 'wlm_equipmentbundle_equipmenttype';
    }
}


