<?php

namespace Wlm\TillBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Till
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Wlm\TillBundle\Entity\TillRepository")
 */
class Till
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
     * @ORM\ManyToOne(targetEntity="Wlm\OperationBundle\Entity\Operation",  inversedBy="tills")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $operation;
   
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="mode", type="string", length=255)
     */
    private $mode;

    public function __construct()
    {
    	$this->amount =0;
    }
    
    
    
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
     * Set date
     *
     * @param \DateTime $date
     * @return Till
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set amount
     *
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    
        return $this;
    }

    /**
     * Get amount
     *
     * @return float 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set mode
     *
     * @param string $modeOfPayment
     * @return Till
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
    
        return $this;
    }

    /**
     * Get mode
     *
     * @return string 
     */
    public function getMode()
    {
        return $this->mode;
    }


    /**
     * Set operation
     *
     * @param \Wlm\OperationBundle\Entity\Operation $operation
     * @return Till
     */
    public function setOperation(\Wlm\OperationBundle\Entity\Operation $operation = null)
    {
        $this->operation = $operation;
    
        return $this;
    }

    /**
     * Get operation
     *
     * @return \Wlm\OperationBundle\Entity\Operation 
     */
    public function getOperation()
    {
        return $this->operation;
    }
}
