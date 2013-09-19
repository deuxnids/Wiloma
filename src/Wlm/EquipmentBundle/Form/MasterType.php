<?php

namespace Wlm\EquipmentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MasterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
        ->add('name','text'  )
        ->add('description','textarea'  )
        ->add('manufacturer','text'  )
        ->add('price','text'  )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Wlm\EquipmentBundle\Entity\Master'
        ));
    }

    public function getName()
    {
        return 'wlm_equipmentbundle_equipmentmastertype';
    }
}
