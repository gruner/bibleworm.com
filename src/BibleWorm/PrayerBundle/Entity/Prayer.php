<?php

namespace BibleWorm\PrayerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use BibleWorm\ApiBundle\Entity\User;
use BibleWorm\PrayerBundle\Entity\Subject;

/**
 * BibleWorm\PrayerBundle\Entity\Prayer
 *
 * @ORM\Table(name="bw_prayer")
 * @ORM\Entity
 */
class Prayer
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="\BibleWormApiBundle:User", inversedBy="prayers")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @XORM\ManyToOne(targetEntity="Subject", inversedBy="prayers")
     * @XORM\JoinColumn(name="subject_id", referencedColumnName="id")
     */
    //private $subject;
    
    /**
     * @ORM\ManyToMany(targetEntity="Tag", mappedBy="prayers")
     * @ORM\JoinTable(name="bw_tag_prayer")
     */
    private $tags;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="notes", type="string", length=255)
     */
    private $notes;

    /**
     * @ORM\Column(name="resolution", type="string", length=255)
     */
    private $resolution;

    /**
     * @ORM\Column(name="is_public", type="boolean")
     */
    private $isPublic;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;
    
    /**
     * Sets defaults when creating a new object
     */
    public function __construct()
    {
        $this->isActive = true;
        $this->isPublic = false;
        $this->tags = new ArrayCollection();
        $this->createdAt = $this->updatedAt = new \DateTime("now");
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function setResolution($resolution)
    {
        $this->resolution = $resolution;
    }

    public function getResolution()
    {
        return $this->resolution;
    }

    /**
     * @param boolean $isPublic
     */
    public function setIsPublic($isPublic)
    {
        $this->isPublic = $isPublic;
    }

    /**
     * @return boolean 
     */
    public function getIsPublic()
    {
        return $this->isPublic;
    }

    /**
     * @param boolean $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return datetime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    
    public function getTags()
    {
        return $this->tags;
    }
    
    public function addTag(Tag $tag)
    {
        $tag->addPrayer($this); // synchronously updating inverse side
        $this->tags[] = $tag;
    }
}