<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Article.
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Article
{
    const STATUS_SENT = 'sent';
    const STATUS_ON_REVIEW = 'on review';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_ACCEPTED_SUGGESTIONS = 'accepted with suggestions';
    const STATUS_REJECTED = 'rejected';

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
     * @ORM\Column(name="title",type="string", length=255)
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     * @Assert\NotBlank
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="keyword", type="string", length=255)
     */
    private $keyword;

    /**
     * @var string
     * @ORM\Column(name="abstract", type="string", length=255)
     *
     * @Assert\NotBlank
     * @Assert\Length(min="5", minMessage="too short"))
     */
    private $abstract;

    /**
     * @var string
     * @ORM\Column(name="stateEnd", type="string", length=255)
     */
    private $stateEnd;

    /**
     * @var \DateTime
     *
     *@ORM\Column(name="created_at", type="datetime")
     */
    private $createAt;

     /**
      * @ORM\ManyToMany(targetEntity="Topic", inversedBy="articles")
      */
     private $topics;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Inscription", inversedBy="articles")
     */
    private $inscription;

    /**
     * @ORM\OneToMany(targetEntity="ArticleReview", mappedBy="article")
     */
    private $articleReviews;

    /**
     * @ORM\OneToMany(targetEntity="Reviewer", mappedBy="article")
     */
    private $reviewers;

    public function __construct()
    {
        $this->articleReviews = new ArrayCollection();
        $this->reviewers = new ArrayCollection();
        $this->topics = new ArrayCollection();
        $this->stateEnd = self::STATUS_SENT;
        $this->createAt = new \DateTime();
    }

    public function __toString()
    {
        return $this->getTitle();
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
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Set author.
     *
     * @param string $author
     *
     * @return Article
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author.
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set keyword.
     *
     * @param string $keyword
     *
     * @return Article
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword.
     *
     * @return string
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * Set abstract.
     *
     * @param string $abstract
     *
     * @return Article
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;

        return $this;
    }

    /**
     * Get abstract.
     *
     * @return string
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * @return string
     */
    public function getStateEnd()
    {
        return $this->stateEnd;
    }

    /**
     * @param string $stateEnd
     */
    public function setStateEnd($stateEnd)
    {
        $this->stateEnd = $stateEnd;
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
     * Add topics.
     *
     * @param \AppBundle\Entity\Topic $topics
     *
     * @return Article
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
     * Add articleReviews.
     *
     * @param \AppBundle\Entity\ArticleReview $articleReviews
     *
     * @return Article
     */
    public function addArticleReview(\AppBundle\Entity\ArticleReview $articleReviews)
    {
        $this->articleReviews[] = $articleReviews;

        return $this;
    }

    /**
     * Remove articleReviews.
     *
     * @param \AppBundle\Entity\ArticleReview $articleReviews
     */
    public function removeArticleReview(\AppBundle\Entity\ArticleReview $articleReviews)
    {
        $this->articleReviews->removeElement($articleReviews);
    }

    /**
     * Get articleReviews.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticleReviews()
    {
        return $this->articleReviews;
    }

    /**
     * Add reviewers.
     *
     * @param \AppBundle\Entity\Reviewer $reviewers
     *
     * @return Article
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
     * Get reviewers.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReviewers()
    {
        return $this->reviewers;
    }

    /**
     * Set inscription.
     *
     * @param \AppBundle\Entity\Inscription $inscription
     *
     * @return Article
     */
    public function setInscription(\AppBundle\Entity\Inscription $inscription = null)
    {
        $this->inscription = $inscription;

        return $this;
    }

    /**
     * Get inscription.
     *
     * @return \AppBundle\Entity\Inscription
     */
    public function getInscription()
    {
        return $this->inscription;
    }
}
