<?php

namespace Wlm\OperationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Wlm\OperationBundle\Validator\AntiFlood;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Wlm\MaterialBundle\Form\LinkMaterialType;

class RentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('outDate','date',array(
            		'widget' => 'single_text',
            		'format' => 'dd-MM-yyyy',
            		'data' => new \DateTime,
            		'attr' => array('class' => 'date')))
            ->add('inDate','date',array(
            		'widget' => 'single_text',
            		'format' => 'dd-MM-yyyy',
            		'attr' => array('class' => 'date')))
            ->add('code', 'integer',array("mapped"=>false,  'constraints' => array(new AntiFlood())));
            		
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Wlm\OperationBundle\Entity\Rent'
        ));
    }

    public function getName()
    {
        return 'wlm_Operationbundle_Operationtype';
    }

    
    
}
