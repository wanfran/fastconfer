<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 17/04/15
 * Time: 18:28
 */

namespace AppBundle\Main\Event;


use AppBundle\Entity\Article;
use Symfony\Component\EventDispatcher\Event;

class StateEndEvent extends Event
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