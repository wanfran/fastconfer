<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ReviemComments.
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ReviewComments
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
     * @ORM\Column(name="comment", type="string", length=255)
     *
     * @Assert\NotBlank
     * @Assert\Length(min="5", minMessage="too short"))
     */
    private $comment;


    /**
     * @var string
     *
     * @ORM\Column(name="privateComment", type="string", length=255)
     *
     * @Assert\NotBlank
     * @Assert\Length(min="5", minMessage="too short"))
     */
    private $privateComment;


    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255)
     */
    private $state;

    /**
     * @var \DateTime
     *
     *@ORM\Column(name="created_at", type="datetime")
     */
    private $createAt;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Reviewer", inversedBy="reviewComments")
     */
    private $reviewer;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="ArticleReview", inversedBy="reviewComments")
     */
    private $articleReview;

    public function __construct()
    {
        $this->createAt = new \DateTime();
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
     * Set comment.
     *
     * @param string $comment
     *
     * @return ReviewComments
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment.
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return string
     */
    public function getPrivateComment()
    {
        return $this->privateComment;
    }

    /**
     * @param string $privateComment
     */
    public function setPrivateComment($privateComment)
    {
        $this->privateComment = $privateComment;
    }



    /**
     * Set state.
     *
     * @param string $state
     *
     * @return ReviewComments
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state.
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return \DateTime
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * @param \DateTime $createAt
     */
    public function setCreateAt($createAt)
    {
        $this->createAt = $createAt;
    }

    /**
     * Set reviewer.
     *
     * @param \AppBundle\Entity\Reviewer $reviewer
     *
     * @return ReviewComments
     */
    public function setReviewer(\AppBundle\Entity\Reviewer $reviewer = null)
    {
        $this->reviewer = $reviewer;

        return $this;
    }

    /**
     * Get reviewer.
     *
     * @return \AppBundle\Entity\Reviewer
     */
    public function getReviewer()
    {
        return $this->reviewer;
    }

    /**
     * Set articleReview.
     *
     * @param \AppBundle\Entity\ArticleReview $articleReview
     *
     * @return ReviewComments
     */
    public function setArticleReview(\AppBundle\Entity\ArticleReview $articleReview = null)
    {
        $this->articleReview = $articleReview;

        return $this;
    }

    /**
     * Get articleReview.
     *
     * @return \AppBundle\Entity\ArticleReview
     */
    public function getArticleReview()
    {
        return $this->articleReview;
    }
}
