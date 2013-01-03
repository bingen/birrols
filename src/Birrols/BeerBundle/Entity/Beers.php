<?php

namespace Birrols\BeerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Birrols\BeerBundle\Entity\Beers
 *
 * @ORM\Table(name="beers")
 * @ORM\Entity(repositoryClass="Birrols\BeerBundle\Entity\BeersRepository")
 */
class Beers
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=false)
     */
    private $name;

    /**
     * @var integer $brewery
     *
     * @ORM\ManyToOne(targetEntity="Business", inversedBy="beers")
     * @ORM\JoinColumn(name="brewery_id", referencedColumnName="id")
     */
    private $brewery;

    /**
     * @var integer $category
     *
     * @ORM\ManyToOne(targetEntity="BeerCategories", inversedBy="beers")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @var integer $type
     *
     * @ORM\ManyToOne(targetEntity="BeerTypes", inversedBy="beers")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    private $type;

    /**
     * @var float $abv
     *
     * @ORM\Column(name="abv", type="decimal", nullable=true)
     */
    private $abv;

    /**
     * @var integer $ibu
     *
     * @ORM\Column(name="ibu", type="integer", nullable=true)
     */
    private $ibu;

    /**
     * @var integer $og
     *
     * @ORM\Column(name="og", type="integer", nullable=true)
     */
    private $og;

    /**
     * @var integer $srm
     *
     * @ORM\Column(name="srm", type="integer", nullable=true)
     */
    private $srm;

    /**
     * @var integer $ebc
     *
     * @ORM\Column(name="ebc", type="integer", nullable=true)
     */
    private $ebc;

    /**
     * @var string $malts
     *
     * @ORM\Column(name="malts", type="string", length=128, nullable=true)
     */
    private $malts;

    /**
     * @var string $hops
     *
     * @ORM\Column(name="hops", type="string", length=128, nullable=true)
     */
    private $hops;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var float $score
     *
     * @ORM\Column(name="score", type="decimal", nullable=true)
     */
    private $score;

    /**
     * @var integer $register
     *
     * @ORM\ManyToOne(targetEntity="Birrols\UserBundle\Entity\Users", inversedBy="beers")
     * @ORM\JoinColumn(name="register_id", referencedColumnName="id")
     */
    private $register;

    /**
     * @ORM\OneToMany(targetEntity="Taps", mappedBy="beer")
     */
    protected $taps;

    public function __construct()
    {
        $this->taps = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Beers
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set abv
     *
     * @param float $abv
     * @return Beers
     */
    public function setAbv($abv)
    {
        $this->abv = $abv;
    
        return $this;
    }

    /**
     * Get abv
     *
     * @return float 
     */
    public function getAbv()
    {
        return $this->abv;
    }

    /**
     * Set ibu
     *
     * @param integer $ibu
     * @return Beers
     */
    public function setIbu($ibu)
    {
        $this->ibu = $ibu;
    
        return $this;
    }

    /**
     * Get ibu
     *
     * @return integer 
     */
    public function getIbu()
    {
        return $this->ibu;
    }

    /**
     * Set og
     *
     * @param integer $og
     * @return Beers
     */
    public function setOg($og)
    {
        $this->og = $og;
    
        return $this;
    }

    /**
     * Get og
     *
     * @return integer 
     */
    public function getOg()
    {
        return $this->og;
    }

    /**
     * Set srm
     *
     * @param integer $srm
     * @return Beers
     */
    public function setSrm($srm)
    {
        $this->srm = $srm;
    
        return $this;
    }

    /**
     * Get srm
     *
     * @return integer 
     */
    public function getSrm()
    {
        return $this->srm;
    }

    /**
     * Set ebc
     *
     * @param integer $ebc
     * @return Beers
     */
    public function setEbc($ebc)
    {
        $this->ebc = $ebc;
    
        return $this;
    }

    /**
     * Get ebc
     *
     * @return integer 
     */
    public function getEbc()
    {
        return $this->ebc;
    }

    /**
     * Set malts
     *
     * @param string $malts
     * @return Beers
     */
    public function setMalts($malts)
    {
        $this->malts = $malts;
    
        return $this;
    }

    /**
     * Get malts
     *
     * @return string 
     */
    public function getMalts()
    {
        return $this->malts;
    }

    /**
     * Set hops
     *
     * @param string $hops
     * @return Beers
     */
    public function setHops($hops)
    {
        $this->hops = $hops;
    
        return $this;
    }

    /**
     * Get hops
     *
     * @return string 
     */
    public function getHops()
    {
        return $this->hops;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Beers
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
     * Set score
     *
     * @param float $score
     * @return Beers
     */
    public function setScore($score)
    {
        $this->score = $score;
    
        return $this;
    }

    /**
     * Get score
     *
     * @return float 
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set brewery
     *
     * @param Birrols\BeerBundle\Entity\Business $brewery
     * @return Beers
     */
    public function setBrewery(\Birrols\BeerBundle\Entity\Business $brewery = null)
    {
        $this->brewery = $brewery;
    
        return $this;
    }

    /**
     * Get brewery
     *
     * @return Birrols\BeerBundle\Entity\Business 
     */
    public function getBrewery()
    {
        return $this->brewery;
    }

    /**
     * Set category
     *
     * @param Birrols\BeerBundle\Entity\BeerCategories $category
     * @return Beers
     */
    public function setCategory(\Birrols\BeerBundle\Entity\BeerCategories $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return Birrols\BeerBundle\Entity\BeerCategories 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set type
     *
     * @param Birrols\BeerBundle\Entity\BeerTypes $type
     * @return Beers
     */
    public function setType(\Birrols\BeerBundle\Entity\BeerTypes $type = null)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return Birrols\BeerBundle\Entity\BeerTypes 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set register
     *
     * @param Birrols\UserBundle\Entity\Users $register
     * @return Beers
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

    /**
     * Add taps
     *
     * @param Birrols\BeerBundle\Entity\Taps $taps
     * @return Beers
     */
    public function addTap(\Birrols\BeerBundle\Entity\Taps $taps)
    {
        $this->taps[] = $taps;
    
        return $this;
    }

    /**
     * Remove taps
     *
     * @param Birrols\BeerBundle\Entity\Taps $taps
     */
    public function removeTap(\Birrols\BeerBundle\Entity\Taps $taps)
    {
        $this->taps->removeElement($taps);
    }

    /**
     * Get taps
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTaps()
    {
        return $this->taps;
    }
}