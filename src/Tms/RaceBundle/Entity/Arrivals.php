<?php

namespace Tms\RaceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Arrivals
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Tms\RaceBundle\Entity\ArrivalsRepository")
 */
class Arrivals
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
     * @var float
     *
     * @ORM\Column(name="timeStop", type="float")
     */
    private $timeStop;

    /**
     * @var integer
     *
     * @ORM\Column(name="code", type="integer", nullable=true)
     */
    private $code;


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
     * Set timeStop
     *
     * @param float $timeStop
     * @return Arrivals
     */
    public function setTimeStop($timeStop)
    {
        $this->timeStop = $timeStop;
    
        return $this;
    }

    /**
     * Get timeStop
     *
     * @return float 
     */
    public function getTimeStop()
    {
        return $this->timeStop;
    }

    /**
     * Set code
     *
     * @param integer $code
     * @return Arrivals
     */
    public function setCode($code)
    {
        $this->code = $code;
    
        return $this;
    }

    /**
     * Get code
     *
     * @return integer 
     */
    public function getCode()
    {
        return $this->code;
    }
}
