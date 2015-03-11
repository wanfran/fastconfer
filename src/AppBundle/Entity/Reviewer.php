<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reviewer
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Reviewer
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="reviewers")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="reviewers")
     */
    private $articles;

    /**
     * @ORM\OneToMany(targetEntity="ReviewComments", mappedBy="reviewers")
     */
    private $reviewComments;

    function __construct()
    {
        $this->reviemComments = new ArrayCollection();
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
     * Set users
     *
     * @param \AppBundle\Entity\User $users
     * @return Reviewer
     */
    public function setUsers(\AppBundle\Entity\User $users = null)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get users
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set articles
     *
     * @param \AppBundle\Entity\Article $articles
     * @return Reviewer
     */
    public function setArticles(\AppBundle\Entity\Article $articles = null)
    {
        $this->articles = $articles;

        return $this;
    }

    /**
     * Get articles
     *
     * @return \AppBundle\Entity\Article 
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Add reviewComments
     *
     * @param \AppBundle\Entity\ReviewComments $reviewComments
     * @return Reviewer
     */
    public function addReviewComment(\AppBundle\Entity\ReviewComments $reviewComments)
    {
        $this->reviewComments[] = $reviewComments;

        return $this;
    }

    /**
     * Remove reviewComments
     *
     * @param \AppBundle\Entity\ReviewComments $reviewComments
     */
    public function removeReviewComment(\AppBundle\Entity\ReviewComments $reviewComments)
    {
        $this->reviewComments->removeElement($reviewComments);
    }

    /**
     * Get reviewComments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReviewComments()
    {
        return $this->reviewComments;
    }
}
