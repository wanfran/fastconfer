<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Article
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
     *
     *
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
     * @ORM\ManyToMany(targetEntity="Topic", inversedBy="articles")
     */
     private $topics;

    /**
     * @ORM\ManyToOne(targetEntity="Inscription", inversedBy="articles")
     *
     */
    private $inscriptions;

    /**
     *
     * @ORM\OneToMany(targetEntity="ArticleReview", mappedBy="articles")
     */
    private $articleReviews;


    function __construct()
    {
        $this->articleReviews = new ArrayCollection();
        $this->topics = new ArrayCollection();
        $this->state = self::STATUS_SENT;
        $this->createAt = new \DateTime();
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
     * Set author
     *
     * @param string $author
     * @return Article
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set keyword
     *
     * @param string $keyword
     * @return Article
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return string 
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * Set abstract
     *
     * @param string $abstract
     * @return Article
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;

        return $this;
    }

    /**
     * Get abstract
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
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
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


//
//    public function getAbsolutePath()
//    {
//        return null === $this->path
//            ? null
//            : $this->getUploadRootDir().'/'.$this->path;
//    }
//
//    public function getWebPath()
//    {
//        return null === $this->path
//            ? null
//            : $this->getUploadDir().'/'.$this->path;
//    }
//
//    protected function getUploadRootDir()
//    {
//        // the absolute directory path where uploaded
//        // documents should be saved
//        return __DIR__.'/../../../../web/'.$this->getUploadDir();
//    }
//
//    protected function getUploadDir()
//    {
//        // get rid of the __DIR__ so it doesn't screw up
//        // when displaying uploaded doc/image in the view.
//        return 'uploads/documents';
//    }
//
//    /**
//     * @Assert\File(maxSize="6000000")
//     */
//    private $file;
//
//    /**
//     * Sets file.
//     *
//     * @param UploadedFile $file
//     */
//    public function setFile(UploadedFile $file = null)
//    {
//        $this->file = $file;
//    }
//
//    /**
//     * Get file.
//     *
//     * @return UploadedFile
//     */
//    public function getFile()
//    {
//        return $this->file;
//    }
//
//    public function upload()
//    {
//        // the file property can be empty if the field is not required
//        if (null === $this->getFile()) {
//            return;
//        }
//
//        // use the original file name here but you should
//        // sanitize it at least to avoid any security issues
//
//        // move takes the target directory and then the
//        // target filename to move to
//        $this->getFile()->move(
//            $this->getUploadRootDir(),
//            $this->getFile()->getClientOriginalName()
//        );
//
//        // set the path property to the filename where you've saved the file
//        $this->path = $this->getFile()->getClientOriginalName();
//
//        // clean up the file property as you won't need it anymore
//        $this->file = null;
//    }
//


    /**
     * Add topics
     *
     * @param \AppBundle\Entity\Topic $topics
     * @return Article
     */
    public function addTopic(\AppBundle\Entity\Topic $topics)
    {
        $this->topics[] = $topics;

        return $this;
    }

    /**
     * Remove topics
     *
     * @param \AppBundle\Entity\Topic $topics
     */
    public function removeTopic(\AppBundle\Entity\Topic $topics)
    {
        $this->topics->removeElement($topics);
    }

    /**
     * Get topics
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTopics()
    {
        return $this->topics;
    }

    /**
     * Set inscriptions
     *
     * @param \AppBundle\Entity\Inscription $inscriptions
     * @return Article
     */
    public function setInscriptions(\AppBundle\Entity\Inscription $inscriptions = null)
    {
        $this->inscriptions = $inscriptions;

        return $this;
    }

    /**
     * Get inscriptions
     *
     * @return \AppBundle\Entity\Inscription 
     */
    public function getInscriptions()
    {
        return $this->inscriptions;
    }
    /**
     * Add articleReviews
     *
     * @param \AppBundle\Entity\ArticleReview $articleReviews
     * @return Article
     */
    public function addArticleReview(\AppBundle\Entity\ArticleReview $articleReviews)
    {
        $this->articleReviews[] = $articleReviews;

        return $this;
    }

    /**
     * Remove articleReviews
     *
     * @param \AppBundle\Entity\ArticleReview $articleReviews
     */
    public function removeArticleReview(\AppBundle\Entity\ArticleReview $articleReviews)
    {
        $this->articleReviews->removeElement($articleReviews);
    }

    /**
     * Get articleReviews
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticleReviews()
    {
        return $this->articleReviews;
    }
}
