<?php

namespace Wlm\OperationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rent
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Wlm\OperationBundle\Entity\RentRepository")
 */
class Rent extends Operation
{

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="outDate", type="datetime")
     */
    private $outDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inDate", type="datetime")
     */
    private $inDate;

    
    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * Set outDate
     *
     * @param \DateTime $outDate
     * @return Rent
     */
    public function setOutDate($outDate)
    {
        $this->outDate = $outDate;
    
        return $this;
    }

    /**
     * Get outDate
     *
     * @return \DateTime 
     */
    public function getOutDate()
    {
        return $this->outDate;
    }

    /**
     * Set inDate
     *
     * @param \DateTime $inDate
     * @return Rent
     */
    public function setInDate($inDate)
    {
        $this->inDate = $inDate;
    
        return $this;
    }

    /**
     * Get inDate
     *
     * @return \DateTime 
     */
    public function getInDate()
    {
        return $this->inDate;
    }
    
    public function getPrice()
    {
    	$pricePerDay = 10.5;
    	$dDiff = $this->getOutDate()->diff($this->getInDate());
    	$price = ($dDiff->days) * $pricePerDay;
    	return $price; 
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Rent
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    public function __construct()
    {
    	$this->status = 'out';
    }
}
