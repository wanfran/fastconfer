<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 14/04/15
 * Time: 19:26
 */

namespace AppBundle\Main\Event;

use AppBundle\Entity\Article;
use Symfony\Component\EventDispatcher\Event;

class AssignReviewerEvent extends Event
{
    private $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function getArticle()
    {
        return $this->article;
    }
}