<?php

namespace Birrols\BeerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Birrols\BeerBundle\Entity\Logs
 *
 * @ORM\Table(name="logs")
 * @ORM\Entity
 */
class Logs
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
     * @var \DateTime $logDate
     *
     * @ORM\Column(name="log_date", type="datetime", nullable=false)
     */
    private $logDate;

    /**
     * @var string $logType
     *
     * @ORM\Column(name="log_type", type="string", length=20, nullable=false)
     */
    private $logType;

    /**
     * @var integer $logRefId
     *
     * @ORM\Column(name="log_ref_id", type="integer", nullable=false)
     */
    private $logRefId;

    /**
     * @var integer $logUser
     *
     * @ORM\ManyToOne(targetEntity="Birrols\UserBundle\Entity\Users", inversedBy="logs")
     * @ORM\JoinColumn(name="log_user_id", referencedColumnName="id")
     */
    private $logUser;

    /**
     * @var string $logIp
     *
     * @ORM\Column(name="log_ip", type="string", length=24, nullable=true)
     */
    private $logIp;



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
     * Set logDate
     *
     * @param \DateTime $logDate
     * @return Logs
     */
    public function setLogDate($logDate)
    {
        $this->logDate = $logDate;
    
        return $this;
    }

    /**
     * Get logDate
     *
     * @return \DateTime 
     */
    public function getLogDate()
    {
        return $this->logDate;
    }

    /**
     * Set logType
     *
     * @param string $logType
     * @return Logs
     */
    public function setLogType($logType)
    {
        $this->logType = $logType;
    
        return $this;
    }

    /**
     * Get logType
     *
     * @return string 
     */
    public function getLogType()
    {
        return $this->logType;
    }

    /**
     * Set logRefId
     *
     * @param integer $logRefId
     * @return Logs
     */
    public function setLogRefId($logRefId)
    {
        $this->logRefId = $logRefId;
    
        return $this;
    }

    /**
     * Get logRefId
     *
     * @return integer 
     */
    public function getLogRefId()
    {
        return $this->logRefId;
    }

    /**
     * Set logIp
     *
     * @param string $logIp
     * @return Logs
     */
    public function setLogIp($logIp)
    {
        $this->logIp = $logIp;
    
        return $this;
    }

    /**
     * Get logIp
     *
     * @return string 
     */
    public function getLogIp()
    {
        return $this->logIp;
    }

    /**
     * Set logUser
     *
     * @param Birrols\UserBundle\Entity\Users $logUser
     * @return Logs
     */
    public function setLogUser(\Birrols\UserBundle\Entity\Users $logUser = null)
    {
        $this->logUser = $logUser;
    
        return $this;
    }

    /**
     * Get logUser
     *
     * @return Birrols\UserBundle\Entity\Users 
     */
    public function getLogUser()
    {
        return $this->logUser;
    }
}