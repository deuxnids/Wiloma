<?php

namespace Wlm\OperationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


class Rents
{
    protected  $rents;

    public function __construct()
    {
        $this->rents = new ArrayCollection();
    }

    public function setRents(ArrayCollection $rents)
    {
        $this->rents = $rents;
        return $this;
    }

    public function getRents()
    {
        return $this->rents;
    }
    public function addRent(Operation $rent)
    {
    	$this->rents->add($rent);
    }
    
    public function removeRent(Operation $rent)
    {
    	// ...
    }
    
}