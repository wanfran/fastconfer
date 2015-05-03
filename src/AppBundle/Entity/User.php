<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseUser as BaseUser;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="sir_id", type="string", length=255, nullable=true)
     */
    protected $sir_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="sir_access_token", type="string", length=255, nullable=true)
     */
    protected $sir_access_token;

    /**
     * @var string
     *
     * @ORM\Column(name="organization", type="string", length=255, nullable=true)
     */
    protected $organization;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Inscription", mappedBy="user")
     */
    protected $inscriptions;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Reviewer", mappedBy="user")
     */
    protected $reviewers;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Conference", mappedBy="chairmans")
     */
    protected $conferences;

    public function __construct()
    {
        $this->reviewers = new ArrayCollection();
        $this->conferences = new ArrayCollection();
        parent::__construct();
    }

    public function __toString()
    {
        return sprintf("%s <%s>",
            $this->getFullname(),
            $this->getEmail()
        );
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
     * @return mixed
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * @param mixed $organization
     */
    public function setOrganization($organization)
    {
        $this->organization = $organization;
    }

    /**
     * @return mixed
     */
    public function getSirId()
    {
        return $this->sir_id;
    }

    /**
     * @param mixed $sir_id
     */
    public function setSirId($sir_id)
    {
        $this->sir_id = $sir_id;
    }

    /**
     * @return int
     */
    public function getSirAccessToken()
    {
        return $this->sir_access_token;
    }

    /**
     * @param int $sir_access_token
     */
    public function setSirAccessToken($sir_access_token)
    {
        $this->sir_access_token = $sir_access_token;
    }

    /**
     * Add inscriptions.
     *
     * @param \AppBundle\Entity\Inscription $inscriptions
     *
     * @return User
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
     * Set reviewers.
     *
     * @param \AppBundle\Entity\Reviewer $reviewers
     *
     * @return User
     */
    public function setReviewers(\AppBundle\Entity\Reviewer $reviewers = null)
    {
        $this->reviewers = $reviewers;

        return $this;
    }

    /**
     * Get reviewers.
     *
     * @return \AppBundle\Entity\Reviewer
     */
    public function getReviewers()
    {
        return $this->reviewers;
    }

    /**
     * Add reviewers.
     *
     * @param \AppBundle\Entity\Reviewer $reviewers
     *
     * @return User
     */
    public function addReviewer(\AppBundle\Entity\Reviewer $reviewers)
    {
        $this->reviewers[] = $reviewers;

        return $this;
    }

    /**
     * Remove reviewers.
     *
     * @param \AppBundle\Entity\Reviewer $reviewers
     */
    public function removeReviewer(\AppBundle\Entity\Reviewer $reviewers)
    {
        $this->reviewers->removeElement($reviewers);
    }

    /**
     * Add conference
     *
     * @param \AppBundle\Entity\Conference $conference
     *
     * @return User
     */
    public function addConference(\AppBundle\Entity\Conference $conference)
    {
        $this->conferences[] = $conference;

        return $this;
    }

    /**
     * Remove conference
     *
     * @param \AppBundle\Entity\Conference $conference
     */
    public function removeConference(\AppBundle\Entity\Conference $conference)
    {
        $this->conferences->removeElement($conference);
    }

    /**
     * Get conferences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConferences()
    {
        return $this->conferences;
    }

    public function getCompleteName()
    {
        return sprintf("%s <%s>",
            $this->getFullname(),
            $this->getEmail()
        );
    }

    /*
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param integer $s Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @param boolean $img True to return a complete IMG tag False for just the URL
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source http://gravatar.com/site/implement/images/php/
     */
    public function getGravatar($s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $this->getEmail() ) ) );
        $url .= "?s=$s&d=$d&r=$r";
        if ( $img ) {
            $url = '<img src="' . $url . '"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }
}
