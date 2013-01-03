<?php

namespace Birrols\BeerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Birrols\BeerBundle\Entity\Business
 *
 * @ORM\Table(name="business")
 * @ORM\Entity
 */
class Business
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
     * @var boolean $brewery
     *
     * @ORM\Column(name="brewery", type="boolean", nullable=false)
     */
    private $brewery;

    /**
     * @var boolean $pub
     *
     * @ORM\Column(name="pub", type="boolean", nullable=false)
     */
    private $pub;

    /**
     * @var boolean $store
     *
     * @ORM\Column(name="store", type="boolean", nullable=false)
     */
    private $store;

    /**
     * @var boolean $homebrewStore
     *
     * @ORM\Column(name="homebrew_store", type="boolean", nullable=false)
     */
    private $homebrewStore;

    /**
     * @var boolean $food
     *
     * @ORM\Column(name="food", type="boolean", nullable=false)
     */
    private $food;

    /**
     * @var boolean $wifi
     *
     * @ORM\Column(name="wifi", type="boolean", nullable=false)
     */
    private $wifi;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=60, nullable=false)
     */
    private $name;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var integer $tapsNumber
     *
     * @ORM\Column(name="taps_number", type="integer", nullable=true)
     */
    private $tapsNumber;

    /**
     * @var float $score
     *
     * @ORM\Column(name="score", type="decimal", nullable=true)
     */
    private $score;

    /**
     * @var string $address1
     *
     * @ORM\Column(name="address_1", type="string", length=128, nullable=true)
     */
    private $address1;

    /**
     * @var string $address2
     *
     * @ORM\Column(name="address_2", type="string", length=128, nullable=true)
     */
    private $address2;

    /**
     * @var string $zipCode
     *
     * @ORM\Column(name="zip_code", type="string", length=10, nullable=true)
     */
    private $zipCode;

    /**
     * @var integer $country
     *
     * @ORM\ManyToOne(targetEntity="Countries", inversedBy="businesses")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     */
    private $country;

    /**
     * @var string $state
     *
     * @ORM\Column(name="state", type="string", length=50, nullable=true)
     */
    private $state;

    /**
     * @var string $city
     *
     * @ORM\Column(name="city", type="string", length=50, nullable=true)
     */
    private $city;

    /**
     * @var string $url
     *
     * @ORM\Column(name="url", type="string", length=128, nullable=false)
     */
    private $url;

    /**
     * @var string $facebookUrl
     *
     * @ORM\Column(name="facebook_url", type="string", length=128, nullable=false)
     */
    private $facebookUrl;

    /**
     * @var string $twitterUrl
     *
     * @ORM\Column(name="twitter_url", type="string", length=128, nullable=false)
     */
    private $twitterUrl;

    /**
     * @var string $gplusUrl
     *
     * @ORM\Column(name="gplus_url", type="string", length=128, nullable=false)
     */
    private $gplusUrl;

    /**
     * @var string $foursquareUrl
     *
     * @ORM\Column(name="4square_url", type="string", length=128, nullable=false)
     */
    private $foursquareUrl;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=64, nullable=false)
     */
    private $email;

    /**
     * @var string $phone
     *
     * @ORM\Column(name="phone", type="string", length=16, nullable=true)
     */
    private $phone;

    /**
     * @var string $lat
     *
     * @ORM\Column(name="lat", type="string", length=10, nullable=true)
     */
    private $lat;

    /**
     * @var string $lon
     *
     * @ORM\Column(name="lon", type="string", length=10, nullable=true)
     */
    private $lon;

    /**
     * @var integer $userAdmin
     *
     * @ORM\ManyToOne(targetEntity="Birrols\UserBundle\Entity\Users", inversedBy="businessesAdmin")
     * @ORM\JoinColumn(name="user_admin_id", referencedColumnName="id")
     */
    private $userAdmin;

    /**
     * @var integer $register
     *
     * @ORM\ManyToOne(targetEntity="Birrols\UserBundle\Entity\Users", inversedBy="businesses")
     * @ORM\JoinColumn(name="register_id", referencedColumnName="id")
     */
    private $register;

    /**
     * @ORM\OneToMany(targetEntity="Beers", mappedBy="brewery")
     */
    protected $beers;

    /**
     * @ORM\OneToMany(targetEntity="Taps", mappedBy="business")
     */
    protected $taps;

    public function __construct()
    {
        $this->beers = new ArrayCollection();
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
     * Set brewery
     *
     * @param boolean $brewery
     * @return Business
     */
    public function setBrewery($brewery)
    {
        $this->brewery = $brewery;
    
        return $this;
    }

    /**
     * Get brewery
     *
     * @return boolean 
     */
    public function getBrewery()
    {
        return $this->brewery;
    }

    /**
     * Set pub
     *
     * @param boolean $pub
     * @return Business
     */
    public function setPub($pub)
    {
        $this->pub = $pub;
    
        return $this;
    }

    /**
     * Get pub
     *
     * @return boolean 
     */
    public function getPub()
    {
        return $this->pub;
    }

    /**
     * Set store
     *
     * @param boolean $store
     * @return Business
     */
    public function setStore($store)
    {
        $this->store = $store;
    
        return $this;
    }

    /**
     * Get store
     *
     * @return boolean 
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * Set homebrewStore
     *
     * @param boolean $homebrewStore
     * @return Business
     */
    public function setHomebrewStore($homebrewStore)
    {
        $this->homebrewStore = $homebrewStore;
    
        return $this;
    }

    /**
     * Get homebrewStore
     *
     * @return boolean 
     */
    public function getHomebrewStore()
    {
        return $this->homebrewStore;
    }

    /**
     * Set food
     *
     * @param boolean $food
     * @return Business
     */
    public function setFood($food)
    {
        $this->food = $food;
    
        return $this;
    }

    /**
     * Get food
     *
     * @return boolean 
     */
    public function getFood()
    {
        return $this->food;
    }

    /**
     * Set wifi
     *
     * @param boolean $wifi
     * @return Business
     */
    public function setWifi($wifi)
    {
        $this->wifi = $wifi;
    
        return $this;
    }

    /**
     * Get wifi
     *
     * @return boolean 
     */
    public function getWifi()
    {
        return $this->wifi;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Business
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
     * Set description
     *
     * @param string $description
     * @return Business
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
     * Set tapsNumber
     *
     * @param integer $tapsNumber
     * @return Business
     */
    public function setTapsNumber($tapsNumber)
    {
        $this->tapsNumber = $tapsNumber;
    
        return $this;
    }

    /**
     * Get tapsNumber
     *
     * @return integer 
     */
    public function getTapsNumber()
    {
        return $this->tapsNumber;
    }

    /**
     * Set score
     *
     * @param float $score
     * @return Business
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
     * Set address1
     *
     * @param string $address1
     * @return Business
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;
    
        return $this;
    }

    /**
     * Get address1
     *
     * @return string 
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set address2
     *
     * @param string $address2
     * @return Business
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
    
        return $this;
    }

    /**
     * Get address2
     *
     * @return string 
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     * @return Business
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    
        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string 
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Business
     */
    public function setState($state)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Business
     */
    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Business
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set facebookUrl
     *
     * @param string $facebookUrl
     * @return Business
     */
    public function setFacebookUrl($facebookUrl)
    {
        $this->facebookUrl = $facebookUrl;
    
        return $this;
    }

    /**
     * Get facebookUrl
     *
     * @return string 
     */
    public function getFacebookUrl()
    {
        return $this->facebookUrl;
    }

    /**
     * Set twitterUrl
     *
     * @param string $twitterUrl
     * @return Business
     */
    public function setTwitterUrl($twitterUrl)
    {
        $this->twitterUrl = $twitterUrl;
    
        return $this;
    }

    /**
     * Get twitterUrl
     *
     * @return string 
     */
    public function getTwitterUrl()
    {
        return $this->twitterUrl;
    }

    /**
     * Set gplusUrl
     *
     * @param string $gplusUrl
     * @return Business
     */
    public function setGplusUrl($gplusUrl)
    {
        $this->gplusUrl = $gplusUrl;
    
        return $this;
    }

    /**
     * Get gplusUrl
     *
     * @return string 
     */
    public function getGplusUrl()
    {
        return $this->gplusUrl;
    }

    /**
     * Set foursquareUrl
     *
     * @param string $foursquareUrl
     * @return Business
     */
    public function setFoursquareUrl($foursquareUrl)
    {
        $this->foursquareUrl = $foursquareUrl;
    
        return $this;
    }

    /**
     * Get foursquareUrl
     *
     * @return string 
     */
    public function getFoursquareUrl()
    {
        return $this->foursquareUrl;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Business
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Business
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set lat
     *
     * @param string $lat
     * @return Business
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    
        return $this;
    }

    /**
     * Get lat
     *
     * @return string 
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lon
     *
     * @param string $lon
     * @return Business
     */
    public function setLon($lon)
    {
        $this->lon = $lon;
    
        return $this;
    }

    /**
     * Get lon
     *
     * @return string 
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * Set country
     *
     * @param Birrols\BeerBundle\Entity\Countries $country
     * @return Business
     */
    public function setCountry(\Birrols\BeerBundle\Entity\Countries $country = null)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return Birrols\BeerBundle\Entity\Countries 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set userAdmin
     *
     * @param Birrols\UserBundle\Entity\Users $userAdmin
     * @return Business
     */
    public function setUserAdmin(\Birrols\UserBundle\Entity\Users $userAdmin = null)
    {
        $this->userAdmin = $userAdmin;
    
        return $this;
    }

    /**
     * Get userAdmin
     *
     * @return Birrols\UserBundle\Entity\Users 
     */
    public function getUserAdmin()
    {
        return $this->userAdmin;
    }

    /**
     * Set register
     *
     * @param Birrols\UserBundle\Entity\Users $register
     * @return Business
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
     * Add beers
     *
     * @param Birrols\BeerBundle\Entity\Beers $beers
     * @return Business
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

    /**
     * Add taps
     *
     * @param Birrols\BeerBundle\Entity\Taps $taps
     * @return Business
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