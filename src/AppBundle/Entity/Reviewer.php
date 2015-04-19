<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Reviewer.
 *
 * @ORM\Table()
 * @ORM\Entity
 * @UniqueEntity(
 *     fields={"user", "article"},
 *     errorPath="user",
 *     message="This user is already a reviewer for this article."
 * )
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
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="reviewers")
     */
    private $article;

    /**
     * @ORM\OneToMany(targetEntity="ReviewComments", mappedBy="reviewer")
     */
    private $reviewComments;

    public function __construct()
    {
        $this->reviemComments = new ArrayCollection();
    }

    public function __toString()
    {
        return sprintf("%s (%s)",
            $this->getUser()->getFullname(),
            $this->getUser()->getOrganization()
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
     * Set user.
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Reviewer
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set article.
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return Reviewer
     */
    public function setArticle(\AppBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article.
     *
     * @return \AppBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Add reviewComments.
     *
     * @param \AppBundle\Entity\ReviewComments $reviewComments
     *
     * @return Reviewer
     */
    public function addReviewComment(\AppBundle\Entity\ReviewComments $reviewComments)
    {
        $this->reviewComments[] = $reviewComments;

        return $this;
    }

    /**
     * Remove reviewComments.
     *
     * @param \AppBundle\Entity\ReviewComments $reviewComments
     */
    public function removeReviewComment(\AppBundle\Entity\ReviewComments $reviewComments)
    {
        $this->reviewComments->removeElement($reviewComments);
    }

    /**
     * Get reviewComments.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReviewComments()
    {
        return $this->reviewComments;
    }
}
