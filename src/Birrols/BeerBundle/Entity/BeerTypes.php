<?php

namespace Birrols\BeerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Birrols\BeerBundle\Entity\BeerTypes
 *
 * @ORM\Table(name="beer_types")
 * @ORM\Entity
 */
class BeerTypes
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
     * @var string $type
     *
     * @ORM\Column(name="type", type="string", length=32, nullable=false)
     */
    private $type;

    /**
     * @var integer $category
     *
     * @ORM\ManyToOne(targetEntity="BeerCategories", inversedBy="types")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;


    /**
     * @ORM\OneToMany(targetEntity="Beers", mappedBy="type")
     */
    protected $beers;

    public function __construct()
    {
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
     * Set type
     *
     * @param string $type
     * @return BeerTypes
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set category
     *
     * @param integer $category
     * @return BeerTypes
     */
    public function setCategory($category)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return integer 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add beers
     *
     * @param Birrols\BeerBundle\Entity\Beers $beers
     * @return BeerTypes
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