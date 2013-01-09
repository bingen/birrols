<?php

namespace Birrols\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Birrols\UserBundle\Entity\Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 *  */
class Users extends BaseUser
{
    /**
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime $date
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=60, nullable=false)
     */
    private $name;

    /**
     * @var string $lastName
     *
     * @ORM\Column(name="last_name", type="string", length=60, nullable=false)
     */
    private $lastName;

    /**
     * @var integer $language
     *
     * @ORM\Column(name="language", type="string", nullable=true)
     */
    private $language;

    /**
     * @var string $url
     *
     * @ORM\Column(name="url", type="string", length=128, nullable=true)
     */
    private $url;

    /**
     * @var string $sex
     *
     * @ORM\Column(name="sex", type="string", length=1, nullable=true)
     */
    private $sex;

    /**
     * @var string $country
     *
     * @ORM\Column(name="country", type="string", length=50, nullable=true)
     */
    private $country;

    /**
     * @var \DateTime $birthday
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     */
    private $birthday;

    /**
     * @var integer $id
     *
     * @ORM\Column(name="google_id", type="string", nullable=true)
     */ 
    protected $googleId;

    /**
     * @ORM\OneToMany(targetEntity="Birrols\BeerBundle\Entity\Beers", mappedBy="register")
     */
    protected $beers;

     /**
     * @ORM\OneToMany(targetEntity="Birrols\BeerBundle\Entity\Business", mappedBy="register")
     */
    protected $businesses;

     /**
     * @ORM\OneToMany(targetEntity="Birrols\BeerBundle\Entity\Business", mappedBy="userAdmin")
     */
    protected $businessesAdmin;

   /**
     * @ORM\OneToMany(targetEntity="Birrols\BeerBundle\Entity\Taps", mappedBy="register")
     */
    protected $taps;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $imagePath;
    public $image;
    // a property used temporarily while updating, to trigger Pre/Post Update
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $imageUpdate;
    // a property used temporarily while deleting
    private $imagenameForRemove;

    public function __construct()
    {
        parent::__construct();
        $this->date = new \DateTime("now");
        $this->beers = new ArrayCollection();
        $this->businesses = new ArrayCollection();
        $this->businessesAdmin = new ArrayCollection();
        $this->taps = new ArrayCollection();
        $this->imageUpdate = 0;
    }

    public function randString( $length ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);
    }
    
    public function getAbsolutePath()
    {
        return null === $this->imagePath
            ? null
            : $this->getUploadRootDir().'/'.$this->id.'.'.$this->imagePath;
    }

    public function getWebPath()
    {
        return null === $this->imagePath
            ? null
            : $this->getUploadDir().'/'.$this->id.'.'.$this->imagePath;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/avatars/users';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->image) {
            $this->imagePath = $this->image->guessExtension();
        }
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->image) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->image->move(
            $this->getUploadRootDir(),
            $this->id.'.'.$this->image->guessExtension()
        );

        unset($this->image);
    }

    /**
     * @ORM\PreRemove()
     */
    public function storeImagenameForRemove()
    {
        $this->imagenameForRemove = $this->getAbsolutePath();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($this->imagenameForRemove) {
            unlink($this->imagenameForRemove);
        }
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
     * Set username
     *
     * @param string $username
     * @return Users
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Users
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
     * Set date
     *
     * @param \DateTime $date
     * @return Users
     */
    public function setDate(\DateTime $date)
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
     * Set name
     *
     * @param string $name
     * @return Users
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
     * Set lastName
     *
     * @param string $lastName
     * @return Users
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
     * Set language
     *
     * @param boolean $language
     * @return Users
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    
        return $this;
    }

    /**
     * Get language
     *
     * @return boolean 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Users
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
     * Set sex
     *
     * @param string $sex
     * @return Users
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    
        return $this;
    }

    /**
     * Get sex
     *
     * @return string 
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Users
     */
    public function setCountry($country)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     * @return Users
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    
        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime 
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Add beers
     *
     * @param Birrols\BeerBundle\Entity\Beers $beers
     * @return Users
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
     * Add businesses
     *
     * @param Birrols\BeerBundle\Entity\Business $businesses
     * @return Users
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

    /**
     * Add businessesAdmin
     *
     * @param Birrols\BeerBundle\Entity\Business $businessesAdmin
     * @return Users
     */
    public function addBusinessesAdmin(\Birrols\BeerBundle\Entity\Business $businessesAdmin)
    {
        $this->businessesAdmin[] = $businessesAdmin;
    
        return $this;
    }

    /**
     * Remove businessesAdmin
     *
     * @param Birrols\BeerBundle\Entity\Business $businessesAdmin
     */
    public function removeBusinessesAdmin(\Birrols\BeerBundle\Entity\Business $businessesAdmin)
    {
        $this->businessesAdmin->removeElement($businessesAdmin);
    }

    /**
     * Get businessesAdmin
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getBusinessesAdmin()
    {
        return $this->businessesAdmin;
    }

    /**
     * Add taps
     *
     * @param Birrols\BeerBundle\Entity\Taps $taps
     * @return Users
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

    /**
     * Set googleId
     *
     * @param integer $googleId
     * @return Users
     */
    public function setGoogleId($googleId)
    {
        $this->googleId = $googleId;
    
        return $this;
    }

    /**
     * Get googleId
     *
     * @return integer 
     */
    public function getGoogleId()
    {
        return $this->googleId;
    }

    /**
     * Set imagePath
     *
     * @param string $imagePath
     * @return Users
     */
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
    
        return $this;
    }

    /**
     * Get imagePath
     *
     * @return string 
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * Set imageUpdate
     *
     * @param integer $imageUpdate
     * @return Users
     */
    public function setImageUpdate($imageUpdate)
    {
        $this->imageUpdate = $imageUpdate;
    
        return $this;
    }

    /**
     * Get imageUpdate
     *
     * @return integer 
     */
    public function getImageUpdate()
    {
        return $this->imageUpdate;
    }
    
    public function getLocale()
    {
        if( $this->language ) {
            if( $this->country ) {
                return $this->language . '_' . $this->country;
            } else {
                return $this->language;
            }
        } else {
            return NULL;
        }
    }
 
    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->language = locale_get_primary_language($locale);
        $this->country = locale_get_region($locale);
        
    }
}