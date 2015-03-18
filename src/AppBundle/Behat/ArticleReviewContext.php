<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 14/01/15
 * Time: 16:29
 */

namespace AppBundle\Behat;

use AppBundle\Entity\ArticleReview;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Exception\ElementNotFoundException;

class ArticleReviewContext extends CoreContext
{
    /**
     *@Given there are following articleReviews:
     *
     *@param TableNode $tableNode
     */
    public function createArticleReview(TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode->getHash() as $articleReviewHash)
        {
            $articleReview = new ArticleReview();
            $articleReview->setState($articleReviewHash['state']);
            $articleReview->setPath($articleReviewHash['path']);
            $articleReview->setArticles($this->findArticle($articleReviewHash['articles']));
            $em->persist($articleReview);
        }
        $em->flush();
    }
}

