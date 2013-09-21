<?php
  
namespace Wlm\OperationBundle\Validator;
 
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
 
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
 
class AntiFloodValidator extends ConstraintValidator
{
  private $request;
  private $em;
 
  // Les arguments déclarés dans la définition du service arrivent au constructeur
  // On doit les enregistrer dans l'objet pour pouvoir s'en resservir dans la méthode validate()
  public function __construct(Request $request, EntityManager $em)
  {
    $this->request = $request;
    $this->em      = $em;
  }
 
  public function validate($value, Constraint $constraint)
  {

     $equipment = $this->em->getRepository('WlmEquipmentBundle:Equipment')->findOneByCode($value);
 
    if ( !isset($equipment) ) {

    	$this->context->addViolation($constraint->message, array('%string%' => $value));
    }
    else 
    {
    	foreach ($equipment->getRents() as $rent)
    	{
    		if( $rent->getStatus()=='out')
    			{
    				$this->context->addViolation($constraint->message, array('%string%' => $value));
    			}
    	}
    	 	
    }
  }
}