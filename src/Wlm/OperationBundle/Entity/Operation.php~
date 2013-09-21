<?php

namespace Wlm\OperationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Wlm\OperationBundle\Validator\AntiFlood;


/**
 * Operation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type = "string")
 * @ORM\DiscriminatorMap({"rent"="Rent"})
 */
class Operation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    

    
    /**
     * @ORM\ManyToOne(targetEntity="Wlm\EquipmentBundle\Entity\Equipment",inversedBy="rents")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $equipment;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Wlm\ClientBundle\Entity\Client")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $client;
    

    /**
     * @var integer
     *
     */
    private $_code;


    /**
     * @var text $type
     * 
     */
    private $type;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Wlm\TillBundle\Entity\Till", mappedBy="operation")
     */
    private $tills;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set _code
     *
     * @param integer $code
     * @return Operation
     */
    public function setCode($code)
    {
        $this->_code = $code;
    
        return $this;
    }

    /**
     * Get _code
     *
     * @return integer 
     */
    public function getCode()
    {
        return $this->_code;
    }

    /**
     * Set equipment
     *
     * @param \Wlm\EquipmentBundle\Entity\Equipment $equipment
     * @return Operation
     */
    public function setEquipment(\Wlm\EquipmentBundle\Entity\Equipment $equipment = null)
    {
        $this->equipment = $equipment;
    
        return $this;
    }

    /**
     * Get equipment
     *
     * @return \Wlm\EquipmentBundle\Entity\Equipment 
     */
    public function getEquipment()
    {
        return $this->equipment;
    }

    /**
     * Set client
     *
     * @param \Wlm\ClientBundle\Entity\Client $client
     * @return Operation
     */
    public function setClient(\Wlm\ClientBundle\Entity\Client $client = null)
    {
        $this->client = $client;
    
        return $this;
    }

    /**
     * Get client
     *
     * @return \Wlm\ClientBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }
    
    /*
     * Set type
     * 
     * @param string $type
     */
    public function setType($type)
    {
    	$this->type= $type;
    }
    
    /*
     * Get type
    *
    * @return string
    */
    public function getType($type)
    {
    	return $this->type;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tills = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add tills
     *
     * @param \Wlm\TillBundle\Entity\Till $tills
     * @return Operation
     */
    public function addTill(\Wlm\TillBundle\Entity\Till $tills)
    {
        $this->tills[] = $tills;
        $tills->setOperation($this);
    
        return $this;
    }

    /**
     * Remove tills
     *
     * @param \Wlm\TillBundle\Entity\Till $tills
     */
    public function removeTill(\Wlm\TillBundle\Entity\Till $tills)
    {
        $this->tills->removeElement($tills);
    }

    /**
     * Get tills
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTills()
    {
        return $this->tills;
    }
    
    public function getAmountOfTills()
    {
    	$amount = 0;
    	foreach ($this->getTills() as $till )
    	{
    		$amount = $amount + $till->getAmount();
    	}
    	return $amount;
    }
    
    public function getAmountDue()
    {
    	$amount = $this->getPrice() - $this->getAmountOfTills();
    	return $amount;
    }
    
    
}
