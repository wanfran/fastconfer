<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ArticleReview
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\Uploadable(filenameGenerator="SHA1")
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
     * @var string
     *
     * @ORM\Column(name="file", type="string", length=255)
     * @Gedmo\UploadableFileName
     */
    private $file;

    /**
     * @ORM\Column(name="mime_type", type="string")
     * @Gedmo\UploadableFileMimeType
     */
    private $mimeType;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255)
     *
     */
    private $state;

    /**
     *
     * @ORM\Column(name="path", type="string", length=255)
     * @Gedmo\UploadableFilePath
     *
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
    private $article;

    /**
     * @ORM\OneToMany(targetEntity="ReviewComments", mappedBy="articleReview")
     */
    private $reviewComments;

    function __construct()
    {
      $this-> createAt = new \DateTime();
      $this-> state = self::STATUS_SENT;
      $this->reviemComments = new ArrayCollection();

    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return mixed
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * @param mixed $mimeType
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;
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
     * Set article
     *
     * @param \AppBundle\Entity\Article $article
     * @return Article_Review
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
