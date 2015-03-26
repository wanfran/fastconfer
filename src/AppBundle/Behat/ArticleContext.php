<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 14/01/15
 * Time: 16:29
 */

namespace AppBundle\Behat;

use AppBundle\Entity\Conference;
use AppBundle\Entity\Inscription;
use AppBundle\Entity\Article;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Exception\ElementNotFoundException;

class ArticleContext extends CoreContext
{
    /**
     * @Given there are following articles:
     *
     * @param TableNode $tableNode
     */
    public function createArticle(TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode->getHash() as $articleHash)
        {


            $articles = new Article();
            $articles->setTitle($articleHash['title']);
            $articles->setAuthor($articleHash['authors']);
            $articles->setKeyword($articleHash['keyword']);
            $articles->setAbstract($articleHash['abstract']);
            $articles->setStateEnd($articleHash['stateEnd']);
            $em->persist($articles);
        }
        $em->flush();
    }

    /**
     * @Given /^I submitted the following articles to "([^".]*)":$/
     *
     */
    public function iSubmittedTheFollowing($name, TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode->getHash() as $articleHash)
        {


            $articles = new Article();
            $articles->setTitle($articleHash['title']);
            $articles->setAuthor($articleHash['authors']);
            $articles->setKeyword($articleHash['keyword']);
            $articles->setAbstract($articleHash['abstract']);
            $articles->setStateEnd($articleHash['stateEnd']);
            $articles->setInscription($this->findInscription($name));
            $em->persist($articles);
        }
        $em->flush();
    }

}