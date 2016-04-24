<?php

namespace Choox\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Created by PhpStorm.
 * User: msoliman
 * Date: 24.04.2016
 * Time: 18:26
 */

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="logo")
 */
class Logo
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $teamName;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $teamNameAlternative;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $teamNameAlternative2;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $originalLogoFile;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $alteredLogoFile;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $teamCountry;

    /**
     * @ORM\Column(type="string", length=300)
     */
    private $teamHint;


    /**
     * @ORM\Column(type="integer")
     */
    private $timesSolved;
    /**
     * @ORM\Column(type="integer")
     */
    private $timesMissed;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="User", inversedBy="logos")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\Column(type="boolean")
     */
    private $approved;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

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
     * Set teamName
     *
     * @param string $teamName
     *
     * @return Logo
     */
    public function setTeamName($teamName)
    {
        $this->teamName = $teamName;

        return $this;
    }

    /**
     * Get teamName
     *
     * @return string
     */
    public function getTeamName()
    {
        return $this->teamName;
    }

    /**
     * Set teamNameAlternative
     *
     * @param string $teamNameAlternative
     *
     * @return Logo
     */
    public function setTeamNameAlternative($teamNameAlternative)
    {
        $this->teamNameAlternative = $teamNameAlternative;

        return $this;
    }

    /**
     * Get teamNameAlternative
     *
     * @return string
     */
    public function getTeamNameAlternative()
    {
        return $this->teamNameAlternative;
    }

    /**
     * Set teamNameAlternative2
     *
     * @param string $teamNameAlternative2
     *
     * @return Logo
     */
    public function setTeamNameAlternative2($teamNameAlternative2)
    {
        $this->teamNameAlternative2 = $teamNameAlternative2;

        return $this;
    }

    /**
     * Get teamNameAlternative2
     *
     * @return string
     */
    public function getTeamNameAlternative2()
    {
        return $this->teamNameAlternative2;
    }

    /**
     * Set originalLogoFile
     *
     * @param string $originalLogoFile
     *
     * @return Logo
     */
    public function setOriginalLogoFile($originalLogoFile)
    {
        $this->originalLogoFile = $originalLogoFile;

        return $this;
    }

    /**
     * Get originalLogoFile
     *
     * @return string
     */
    public function getOriginalLogoFile()
    {
        return $this->originalLogoFile;
    }

    /**
     * Set alteredLogoFile
     *
     * @param string $alteredLogoFile
     *
     * @return Logo
     */
    public function setAlteredLogoFile($alteredLogoFile)
    {
        $this->alteredLogoFile = $alteredLogoFile;

        return $this;
    }

    /**
     * Get alteredLogoFile
     *
     * @return string
     */
    public function getAlteredLogoFile()
    {
        return $this->alteredLogoFile;
    }

    /**
     * Set teamCountry
     *
     * @param string $teamCountry
     *
     * @return Logo
     */
    public function setTeamCountry($teamCountry)
    {
        $this->teamCountry = $teamCountry;

        return $this;
    }

    /**
     * Get teamCountry
     *
     * @return string
     */
    public function getTeamCountry()
    {
        return $this->teamCountry;
    }

    /**
     * Set teamHint
     *
     * @param string $teamHint
     *
     * @return Logo
     */
    public function setTeamHint($teamHint)
    {
        $this->teamHint = $teamHint;

        return $this;
    }

    /**
     * Get teamHint
     *
     * @return string
     */
    public function getTeamHint()
    {
        return $this->teamHint;
    }

    /**
     * Set timesSolved
     *
     * @param integer $timesSolved
     *
     * @return Logo
     */
    public function setTimesSolved($timesSolved)
    {
        $this->timesSolved = $timesSolved;

        return $this;
    }

    /**
     * Get timesSolved
     *
     * @return integer
     */
    public function getTimesSolved()
    {
        return $this->timesSolved;
    }

    /**
     * Set timesMissed
     *
     * @param integer $timesMissed
     *
     * @return Logo
     */
    public function setTimesMissed($timesMissed)
    {
        $this->timesMissed = $timesMissed;

        return $this;
    }

    /**
     * Get timesMissed
     *
     * @return integer
     */
    public function getTimesMissed()
    {
        return $this->timesMissed;
    }

    /**
     * Set user
     *
     * @param integer $user
     *
     * @return Logo
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return integer
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set approved
     *
     * @param boolean $approved
     *
     * @return Logo
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;

        return $this;
    }

    /**
     * Get approved
     *
     * @return boolean
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @ORM\PrePersist
     *
     * @return Logo
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @ORM\PreUpdate
     *
     * @return Logo
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
