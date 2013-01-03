<?php

namespace Birrols\BeerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Birrols\BeerBundle\Entity\Countries
 *
 * @ORM\Table(name="countries")
 * @ORM\Entity
 */
class Countries
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
     * @var boolean $language
     *
     * @ORM\ManyToOne(targetEntity="Languages", inversedBy="countries")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     */
    private $language;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=60, nullable=false)
     */
    private $name;

    /**
     * @var string $alternativeSpellings
     *
     * @ORM\Column(name="alternative_spellings", type="string", length=128, nullable=true)
     */
    private $alternativeSpellings;

    /**
     * @var float $relevancy
     *
     * @ORM\Column(name="relevancy", type="decimal", nullable=true)
     */
    private $relevancy;

    /**
     * @ORM\OneToMany(targetEntity="Business", mappedBy="country")
     */
    protected $businesses;

    public function __construct()
    {
        $this->businesess = new ArrayCollection();
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
     * @return Countries
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
     * Set alternativeSpellings
     *
     * @param string $alternativeSpellings
     * @return Countries
     */
    public function setAlternativeSpellings($alternativeSpellings)
    {
        $this->alternativeSpellings = $alternativeSpellings;
    
        return $this;
    }

    /**
     * Get alternativeSpellings
     *
     * @return string 
     */
    public function getAlternativeSpellings()
    {
        return $this->alternativeSpellings;
    }

    /**
     * Set relevancy
     *
     * @param float $relevancy
     * @return Countries
     */
    public function setRelevancy($relevancy)
    {
        $this->relevancy = $relevancy;
    
        return $this;
    }

    /**
     * Get relevancy
     *
     * @return float 
     */
    public function getRelevancy()
    {
        return $this->relevancy;
    }

    /**
     * Set language
     *
     * @param Birrols\BeerBundle\Entity\Languages $language
     * @return Countries
     */
    public function setLanguage(\Birrols\BeerBundle\Entity\Languages $language = null)
    {
        $this->language = $language;
    
        return $this;
    }

    /**
     * Get language
     *
     * @return Birrols\BeerBundle\Entity\Languages 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Add businesses
     *
     * @param Birrols\BeerBundle\Entity\Business $businesses
     * @return Countries
     */
    public function addBusinesse(\Birrols\BeerBundle\Entity\Business $businesses)
    {
        $this->businesses[] = $businesses;
    
        return $this;
    }

    /**
     * Remove businesses
     *
     * @param Birrols\BeerBundle\Entity\Business $businesses
     */
    public function removeBusinesse(\Birrols\BeerBundle\Entity\Business $businesses)
    {
        $this->businesses->removeElement($businesses);
    }

    /**
     * Get businesses
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getBusinesses()
    {
        return $this->businesses;
    }
}