<?php

namespace ChooxBundle\Entity;

use ChooxBundle\UserBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Created by PhpStorm.
 * User: msoliman
 * Date: 24.04.2016
 * Time: 18:26
 */

/**
 * @ORM\Entity(repositoryClass="LogoRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="logo")
 * @UniqueEntity("teamName");
 * @UniqueEntity("teamNameAlternatives");
 * @Vich\Uploadable
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
     * @Assert\NotBlank()
     */
    private $teamName;

    /**
     * @ORM\Column(type="json_array", length=500, nullable=true)
     *
     */
    private $teamNameAlternatives;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $teamCountry;

    /**
     * @ORM\Column(type="string", length=300)
     * @Assert\NotBlank()
     */
    private $teamHint;


    /**
     * @ORM\Column(type="integer")
     */
    private $timesSolved = 0;
    /**
     * @ORM\Column(type="integer")
     */
    private $timesMissed = 0;

    /**
     * @ORM\ManyToOne(targetEntity="ChooxBundle\UserBundle\Entity\User", inversedBy="logos")
     * @ORM\JoinColumn(name="user", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="boolean")
     */
    private $approved = false;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="logo_original", fileNameProperty="originalLogo")
     * @Assert\NotBlank()
     *
     * @var File
     */
    private $originalLogoFile;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $originalLogo;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="logo_altered", fileNameProperty="alteredLogo")
     * @Assert\NotBlank()
     *
     * @var File
     */
    private $alteredLogoFile;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $alteredLogo;


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
     * @return mixed
     */
    public function getTeamNameAlternatives()
    {
        return $this->teamNameAlternatives;
    }

    /**
     * @param mixed $teamNameAlternatives
     * @return Logo
     */
    public function setTeamNameAlternatives($teamNameAlternatives)
    {
        $this->teamNameAlternatives = $teamNameAlternatives;
        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $originalLogoFile
     *
     * @return Logo
     */
    public function setOriginalLogoFile(File $originalLogoFile = null)
    {
        $this->originalLogoFile = $originalLogoFile;

        if ($originalLogoFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * Get originalLogoFile
     *
     * @return File
     */
    public function getOriginalLogoFile()
    {
        return $this->originalLogoFile;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $alteredLogoFile
     *
     * @return Logo
     */
    public function setAlteredLogoFile(File $alteredLogoFile = null)
    {
        $this->alteredLogoFile = $alteredLogoFile;

        if ($alteredLogoFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * Get alteredLogoFile
     *
     * @return File
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
     * @return User
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
     * @ORM\PreUpdate
     *
     * @return Logo
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime();

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

    /**
     * Set originalLogo
     *
     * @param string $originalLogo
     *
     * @return Logo
     */
    public function setOriginalLogo($originalLogo)
    {
        $this->originalLogo = $originalLogo;

        return $this;
    }

    /**
     * Get originalLogo
     *
     * @return string
     */
    public function getOriginalLogo()
    {
        return $this->originalLogo;
    }

    /**
     * Set alteredLogo
     *
     * @param string $alteredLogo
     *
     * @return Logo
     */
    public function setAlteredLogo($alteredLogo)
    {
        $this->alteredLogo = $alteredLogo;

        return $this;
    }

    /**
     * Get alteredLogo
     *
     * @return string
     */
    public function getAlteredLogo()
    {
        return $this->alteredLogo;
    }
}
