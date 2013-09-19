<?php

namespace Ghw\MatchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Request
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ghw\MatchBundle\Entity\RequestRepository")
 */
class Request
{

    /**
    * @ORM\ManyToOne(targetEntity="Ghw\UserBundle\Entity\User")
    */
    private $user;

    /**
    * @ORM\ManyToOne(targetEntity="Ghw\UserBundle\Entity\User")
    */
    private $writer;


    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description="";

    /**
     * @var string
     *
     * @ORM\Column(name="letter", type="text")
     */
    private $letter="";


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
     * @return Request
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
     * Set description
     *
     * @param string $description
     * @return Request
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set letter
     *
     * @param string $letter
     * @return Request
     */
    public function setLetter($letter)
    {
        $this->letter = $letter;
    
        return $this;
    }

    /**
     * Get letter
     *
     * @return string 
     */
    public function getLetter()
    {
        return $this->letter;
    }

      public function __construct()
      {
        $this->date         = new \Datetime;
      }

    /**
    * Set user
    *
    * @param Ghw\UserBundle\Entity\User $user
    */
    public function setUser(\Ghw\UserBundle\Entity\User $user)
    {
    $this->user = $user;
    }

    /**
    * Get user
    *
    * @return Ghw\UserBundle\Entity\User
    */
    public function getUser()
    {
    return $this->user;
    }

    /**
    * Set writer
    *
    * @param Ghw\UserBundle\Entity\User $writer
    */
    public function setWriter(\Ghw\UserBundle\Entity\User $writer)
    {
    $this->writer = $writer;
    }

    /**
    * Get writer
    *
    * @return Ghw\UserBundle\Entity\User
    */
    public function getWriter()
    {
    return $this->writer;
    }


}
