<?php

namespace Birrols\BeerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Birrols\BeerBundle\Entity\BeerCategories
 *
 * @ORM\Table(name="beer_categories")
 * @ORM\Entity
 */
class BeerCategories
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
     * @var string $category
     *
     * @ORM\Column(name="category", type="string", length=10, nullable=false)
     */
    private $category;


    /**
     * @ORM\OneToMany(targetEntity="BeerTypes", mappedBy="category")
     */
    protected $types;

    /**
     * @ORM\OneToMany(targetEntity="Beers", mappedBy="category")
     */
    protected $beers;

    public function __construct()
    {
        $this->types = new ArrayCollection();
        $this->beers = new ArrayCollection();
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
     * Set category
     *
     * @param string $category
     * @return BeerCategories
     */
    public function setCategory($category)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add types
     *
     * @param Birrols\BeerBundle\Entity\BeerTypes $types
     * @return BeerCategories
     */
    public function addType(\Birrols\BeerBundle\Entity\BeerTypes $types)
    {
        $this->types[] = $types;
    
        return $this;
    }

    /**
     * Remove types
     *
     * @param Birrols\BeerBundle\Entity\BeerTypes $types
     */
    public function removeType(\Birrols\BeerBundle\Entity\BeerTypes $types)
    {
        $this->types->removeElement($types);
    }

    /**
     * Get types
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Add beers
     *
     * @param Birrols\BeerBundle\Entity\Beers $beers
     * @return BeerCategories
     */
    public function addBeer(\Birrols\BeerBundle\Entity\Beers $beers)
    {
        $this->beers[] = $beers;
    
        return $this;
    }

    /**
     * Remove beers
     *
     * @param Birrols\BeerBundle\Entity\Beers $beers
     */
    public function removeBeer(\Birrols\BeerBundle\Entity\Beers $beers)
    {
        $this->beers->removeElement($beers);
    }

    /**
     * Get beers
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getBeers()
    {
        return $this->beers;
    }
}