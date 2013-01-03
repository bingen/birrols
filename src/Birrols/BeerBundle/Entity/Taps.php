<?php

namespace Birrols\BeerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Birrols\BeerBundle\Entity\Taps
 *
 * @ORM\Table(name="taps")
 * @ORM\Entity
 */
class Taps
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer $business
     *
     * @ORM\ManyToOne(targetEntity="Business", inversedBy="taps")
     * @ORM\JoinColumn(name="business_id", referencedColumnName="id")
     */
    private $business;

    /**
     * @var integer $tapId
     *
     * @ORM\Column(name="tap_id", type="integer", nullable=false)
     */
    private $tapId;

    /**
     * @var integer $beer
     *
     * @ORM\ManyToOne(targetEntity="Beers", inversedBy="taps")
     * @ORM\JoinColumn(name="beer_id", referencedColumnName="id")
     */
    private $beer;

    /**
     * @var boolean $actual
     *
     * @ORM\Column(name="actual", type="boolean", nullable=true)
     */
    private $actual;

    /**
     * @var integer $register
     *
     * @ORM\ManyToOne(targetEntity="Birrols\UserBundle\Entity\Users", inversedBy="taps")
     * @ORM\JoinColumn(name="register_id", referencedColumnName="id")
     */
    private $register;

    /**
     * @var \DateTime $modified
     *
     * @ORM\Column(name="modified", type="datetime", nullable=false)
     */
    private $modified;



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
     * Set tapId
     *
     * @param integer $tapId
     * @return Taps
     */
    public function setTapId($tapId)
    {
        $this->tapId = $tapId;
    
        return $this;
    }

    /**
     * Get tapId
     *
     * @return integer 
     */
    public function getTapId()
    {
        return $this->tapId;
    }

    /**
     * Set actual
     *
     * @param boolean $actual
     * @return Taps
     */
    public function setActual($actual)
    {
        $this->actual = $actual;
    
        return $this;
    }

    /**
     * Get actual
     *
     * @return boolean 
     */
    public function getActual()
    {
        return $this->actual;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     * @return Taps
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
    
        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime 
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Set business
     *
     * @param Birrols\BeerBundle\Entity\Business $business
     * @return Taps
     */
    public function setBusiness(\Birrols\BeerBundle\Entity\Business $business = null)
    {
        $this->business = $business;
    
        return $this;
    }

    /**
     * Get business
     *
     * @return Birrols\BeerBundle\Entity\Business 
     */
    public function getBusiness()
    {
        return $this->business;
    }

    /**
     * Set beer
     *
     * @param Birrols\BeerBundle\Entity\Beers $beer
     * @return Taps
     */
    public function setBeer(\Birrols\BeerBundle\Entity\Beers $beer = null)
    {
        $this->beer = $beer;
    
        return $this;
    }

    /**
     * Get beer
     *
     * @return Birrols\BeerBundle\Entity\Beers 
     */
    public function getBeer()
    {
        return $this->beer;
    }

    /**
     * Set register
     *
     * @param Birrols\UserBundle\Entity\Users $register
     * @return Taps
     */
    public function setRegister(\Birrols\UserBundle\Entity\Users $register = null)
    {
        $this->register = $register;
    
        return $this;
    }

    /**
     * Get register
     *
     * @return Birrols\UserBundle\Entity\Users 
     */
    public function getRegister()
    {
        return $this->register;
    }
}