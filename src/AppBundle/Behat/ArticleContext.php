<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 14/01/15
 * Time: 16:29.
 */

namespace AppBundle\Behat;

use AppBundle\Entity\Article;
use Behat\Gherkin\Node\TableNode;

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
        foreach ($tableNode->getHash() as $articleHash) {
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
     */
    public function iSubmittedTheFollowing($name, TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode->getHash() as $articleHash) {
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

    /**
     * @Given I am on the new article page for :name
     */
    public function iAmOnConferencePage($name)
    {
        $conference = $this->getEntityManager()->getRepository('AppBundle:Conference')->findOneByName($name);
        if (!$conference) {
            throw new ElementNotFoundException('Conference doesn\'t exist');
        }
        
        $this->getSession()->visit($this->generateUrl('article_new', array('code' => $conference->getCode()),true));
    }
}
