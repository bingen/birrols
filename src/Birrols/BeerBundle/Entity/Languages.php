<?php

namespace Birrols\BeerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Birrols\BeerBundle\Entity\Languages
 *
 * @ORM\Table(name="languages")
 * @ORM\Entity
 */
class Languages
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
     * @var string $language
     *
     * @ORM\Column(name="language", type="string", length=32, nullable=false)
     */
    private $language;

    /**
     * @var string $locale
     *
     * @ORM\Column(name="locale", type="string", length=10, nullable=true)
     */
    private $locale;

    /**
     * @ORM\OneToMany(targetEntity="Birrols\UserBundle\Entity\Users", mappedBy="language")
     */
    protected $users;

    /**
     * @ORM\OneToMany(targetEntity="Countries", mappedBy="language")
     */
    protected $countries;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->countries = new ArrayCollection();
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
     * Set language
     *
     * @param string $language
     * @return Languages
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    
        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set locale
     *
     * @param string $locale
     * @return Languages
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    
        return $this;
    }

    /**
     * Get locale
     *
     * @return string 
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Add users
     *
     * @param Birrols\UserBundle\Entity\Users $users
     * @return Languages
     */
    public function addUser(\Birrols\UserBundle\Entity\Users $users)
    {
        $this->users[] = $users;
    
        return $this;
    }

    /**
     * Remove users
     *
     * @param Birrols\UserBundle\Entity\Users $users
     */
    public function removeUser(\Birrols\UserBundle\Entity\Users $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add countries
     *
     * @param Birrols\BeerBundle\Entity\Countries $countries
     * @return Languages
     */
    public function addCountrie(\Birrols\BeerBundle\Entity\Countries $countries)
    {
        $this->countries[] = $countries;
    
        return $this;
    }

    /**
     * Remove countries
     *
     * @param Birrols\BeerBundle\Entity\Countries $countries
     */
    public function removeCountrie(\Birrols\BeerBundle\Entity\Countries $countries)
    {
        $this->countries->removeElement($countries);
    }

    /**
     * Get countries
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCountries()
    {
        return $this->countries;
    }
}