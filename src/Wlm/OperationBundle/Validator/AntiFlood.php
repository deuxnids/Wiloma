<?php
namespace Wlm\OperationBundle\Validator;
 
use Symfony\Component\Validator\Constraint;
 
/**
 * @Annotation
 */
class AntiFlood extends Constraint
{
  public $message = ' %string%  merci d\'attendre un peu.';
  public function validatedBy()
  {
  	return 'wlm_antiflood'; // Ici, on fait appel à l'alias du service
  }
}