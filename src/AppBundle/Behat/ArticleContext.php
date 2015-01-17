<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 14/01/15
 * Time: 16:29
 */

namespace AppBundle\Behat;

use AppBundle\Entity\Article;
use Behat\Gherkin\Node\TableNode;

class ArticleContext extends CoreContext
{
    /**
     * @Given que existen los siguientes artículos:
     *@Then existen los siguientes revisores:
     *
     *@param TableNode $tableNode
     */
    public function createArticle(TableNode $tableNode)
    {
        $em=$this->getEntityManager();
        foreach ($tableNode->getHash() as $articleHash)
        {
            $articles= new Article();
            $articles->setTitle($articleHash['title']);
            $articles->getDescription($articleHash['description']);
            $articles->getArticleSend($articleHash['articleSend']);
            $em->persist($articles);
        }
        $em->flush();
    }


}