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

    /** @ORM\Column(name="google_id", type="string", length=255, nullable=true) */
    protected $google_id;

    /** @ORM\Column(name="google_access_token", type="string", length=255, nullable=true) */
    protected $google_access_token;

    /** @ORM\Column(name="organization", type="string", length=255, nullable=true) */
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
    public function getGoogleId()
    {
        return $this->google_id;
    }

    /**
     * @param mixed $google_id
     */
    public function setGoogleId($google_id)
    {
        $this->google_id = $google_id;
    }

    /**
     * @return mixed
     */
    public function getGoogleAccessToken()
    {
        return $this->google_access_token;
    }

    /**
     * @param mixed $google_access_token
     */
    public function setGoogleAccessToken($google_access_token)
    {
        $this->google_access_token = $google_access_token;
    }

    //YOU CAN ADD MORE CODE HERE !

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
}
