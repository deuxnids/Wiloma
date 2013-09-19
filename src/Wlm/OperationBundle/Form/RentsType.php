<?php

namespace Wlm\OperationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Wlm\LocationBundle\Entity\Operations;
use Wlm\LocationBundle\Entity\Operation;


class RentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(	'rents', 'collection', 
        				 array(
                    		'type'         => new RentType(),
                    		'allow_add'    => true,
                    		'allow_delete' => true,
                    ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Wlm\OperationBundle\Entity\Rents',
            'cascade_validation' => true,
        ));
        
        
    }

    public function getName()
    {
        return 'wlm_operationbundle__operationstype';
    }
}
