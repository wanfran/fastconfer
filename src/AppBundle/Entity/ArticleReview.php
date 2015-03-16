<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ArticleReview
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ArticleReview
{


    const STATUS_SENT = 'sent';
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
     * @var integer
     *
     * @ORM\Column(name="number_review", type="integer")
     */
    private $numberReview;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var \DateTime
     *
     *@ORM\Column(name="created_at", type="datetime")
     *
     */
    private $createAt;

    /**
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="articleReviews")
     */
    private $articles;

    /**
     * @ORM\OneToMany(targetEntity="ReviewComments", mappedBy="articleReviews")
     */
    private $reviewComments;

    function __construct()
    {
      $this-> createAt = new \DateTime();
      $this-> state = self::STATUS_SENT;
      $this -> numberReview = new ArrayCollection();
      $this->reviemComments = new ArrayCollection();
    }


    public function count()
    {
        return count($this->numberReview);
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
     * Set numberReview
     *
     * @param integer $numberReview
     * @return Article_Review
     */
    public function setNumberReview($numberReview)
    {
        $this->numberReview = $numberReview;

        return $this;
    }

    /**
     * Get numberReview
     *
     * @return integer 
     */
    public function getNumberReview()
    {
        return $this->numberReview;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Article_Review
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Article_Review
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
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
     * Set articles
     *
     * @param \AppBundle\Entity\Article $articles
     * @return Article_Review
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
     * @return ArticleReview
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
