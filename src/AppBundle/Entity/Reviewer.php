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
    private $article;

    /**
     * @ORM\OneToMany(targetEntity="ReviewComments", mappedBy="reviewer")
     */
    private $reviewComments;

    function __construct()
    {
        $this->reviemComments = new ArrayCollection();

    }

    function __toString()
    {
        return sprintf("%s (%s)",
            $this->getUsers()->getFullname(),
            $this->getUsers()->getOrganization()
        );
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
     * Set article
     *
     * @param \AppBundle\Entity\Article $article
     * @return Reviewer
     */
    public function setArticle(\AppBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \AppBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
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
