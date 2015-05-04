<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Conference.
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ConferenceRepository")
 */
class Conference
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=2000)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="code", length=32, unique=true, nullable=false)
     */
    private $code;

    /**
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var string
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateStart", type="datetime")
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnd", type="datetime")
     */
    private $dateEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deadTime", type="datetime")
     */
    private $deadTime;

    /**
     * @var \DateTime
     *
     *@ORM\Column(name="dateNews", type="datetime")
     */
    private $dateNews;

    /**
     * @ORM\ManyToMany(targetEntity="Topic", inversedBy="conferences")
     */
    private $topics;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", inversedBy="conferences")
     */
    private $chairmans;

    /**
     * @ORM\OneToMany(targetEntity="Inscription", mappedBy="conference")
     */
    private $inscriptions;

    public function __construct()
    {
        $this->topics = new ArrayCollection();
        $this->inscriptions = new ArrayCollection();
        $this->chairmans = new ArrayCollection();
    }

    /**
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * @param \DateTime $dateStart
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;
    }

    /**
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @param \DateTime $dateEnd
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
    }

    /**
     * @return \DateTime
     */
    public function getDeadTime()
    {
        return $this->deadTime;
    }

    /**
     * @param \DateTime $deadTime
     */
    public function setDeadTime($deadTime)
    {
        $this->deadTime = $deadTime;
    }

    /**
     * @return \DateTime
     */
    public function getDateNews()
    {
        return $this->dateNews;
    }

    /**
     * @param \DateTime $dateNews
     */
    public function setDateNews($dateNews)
    {
        $this->dateNews = $dateNews;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }



    /**
     * Get id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Conference
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description.
     *

     * @param string $description
     *
     * @return Conference
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set image.
     *
     * @param string $image
     *
     * @return Conference
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image.
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add topics.
     *
     * @param \AppBundle\Entity\Topic $topics
     *
     * @return Conference
     */
    public function addTopic(\AppBundle\Entity\Topic $topics)
    {
        $this->topics[] = $topics;

        return $this;
    }

    /**
     * Remove topics.
     *
     * @param \AppBundle\Entity\Topic $topics
     */
    public function removeTopic(\AppBundle\Entity\Topic $topics)
    {
        $this->topics->removeElement($topics);
    }

    /**
     * Get topics.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTopics()
    {
        return $this->topics;
    }

    /**
     * Add inscriptions.
     *
     * @param \AppBundle\Entity\Inscription $inscriptions
     *
     * @return Conference
     */
    public function addInscription(\AppBundle\Entity\Inscription $inscriptions)
    {
        $this->inscriptions[] = $inscriptions;

        return $this;
    }

    /**
     * Remove inscriptions.
     *
     * @param \AppBundle\Entity\Inscription $inscriptions
     */
    public function removeInscription(\AppBundle\Entity\Inscription $inscriptions)
    {
        $this->inscriptions->removeElement($inscriptions);
    }

    /**
     * Get inscriptions.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInscriptions()
    {
        return $this->inscriptions;
    }

    /**
     * To string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode( $code )
    {
        $this->code = $code;
    }

    /**
     * Add chairman
     *
     * @param \AppBundle\Entity\User $chairman
     *
     * @return Conference
     */
    public function addChairman(\AppBundle\Entity\User $chairman)
    {
        $this->chairmans[] = $chairman;

        return $this;
    }

    /**
     * Remove chairman
     *
     * @param \AppBundle\Entity\User $chairman
     */
    public function removeChairman(\AppBundle\Entity\User $chairman)
    {
        $this->chairmans->removeElement($chairman);
    }

    /**
     * Get chairmans
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChairmans()
    {
        return $this->chairmans;
    }
}
