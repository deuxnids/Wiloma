<?php

namespace Tms\RunnerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Runner
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Tms\RunnerBundle\Entity\RunnerRepository")
 */
class Runner
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
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     */
    private $firstName;

    /**
     * @var float
     *
     * @ORM\Column(name="timeStart", type="float", nullable=True)
     */
    private $timeStart;

    /**
     * @var float
     *
     * @ORM\Column(name="timeStop", type="float",  nullable=True)
     */
    private $timeStop;

    /**
     * @var integer
     *
     * @ORM\Column(name="code", type="integer")
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
     * Set lastName
     *
     * @param string $lastName
     * @return Runner
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    
        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Runner
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    
        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set timeStart
     *
     * @param \DateTime $timeStart
     * @return Runner
     */
    public function setTimeStart($timeStart)
    {
        $this->timeStart = $timeStart;
    
        return $this;
    }

    /**
     * Get timeStart
     *
     * @return \DateTime 
     */
    public function getTimeStart()
    {
        return $this->timeStart;
    }

    /**
     * Set timeStop
     *
     * @param \DateTime $timeStop
     * @return Runner
     */
    public function setTimeStop($timeStop)
    {
        $this->timeStop = $timeStop;
    
        return $this;
    }

    /**
     * Get timeStop
     *
     * @return \DateTime 
     */
    public function getTimeStop()
    {
        return $this->timeStop;
    }

    /**
     * Set code
     *
     * @param integer $code
     * @return Runner
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
