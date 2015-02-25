<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 14/01/15
 * Time: 16:29
 */

namespace AppBundle\Behat;

use AppBundle\Entity\Conference;
use AppBundle\Entity\Article;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Exception\ElementNotFoundException;

class ArticleContext extends CoreContext
{
    /**
     *@Given there are following articles:
     *
     *@param TableNode $tableNode
     */
    public function createArticle(TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode->getHash() as $articleHash)
        {
            $articles = new Article();
            $articles->setAuthor($articleHash['authors']);
            $articles->setKeyword($articleHash['keyword']);
            $articles->setAbstract($articleHash['abstract']);
            $articles->setPath($articleHash['path']);
            $articles->setState($articleHash['state']);
            $em->persist($articles);
        }
        $em->flush();
    }
}