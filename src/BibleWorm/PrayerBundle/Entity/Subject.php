<?php

namespace BibleWorm\PrayerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * BibleWorm\PrayerBundle\Entity\PrayerSubject
 *
 * @ORM\Table(name="bw_prayer_subject")
 * @ORM\Entity
 */
class Subject
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updated_at;
    
    /**
     * @ORM\OneToMany(targetEntity="Prayer", mappedBy="subject")
     */
    private $prayers;
    
    public function __construct()
    {
        $this->prayers = new ArrayCollection();
        $this->created_at = $this->updated_at = new \DateTime("now");
    }

    /**
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return datetime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}