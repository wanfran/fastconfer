<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 14/01/15
 * Time: 16:29.
 */

namespace AppBundle\Behat;

use AppBundle\ENtity\Article;
use AppBundle\Entity\ArticleReview;
use AppBundle\Entity\ReviewComments;
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
        foreach ($tableNode->getHash() as $articleReviewHash) {
            $articleReview = new ArticleReview();
            $articleReview->setFile('file');
            $articleReview->setMimeType('mimeType');
            $articleReview->setState($articleReviewHash['state']);
            $articleReview->setPath($articleReviewHash['path']);
            $articleReview->setArticle($this->findArticle($articleReviewHash['article']));
            $em->persist($articleReview);
        }
        $em->flush();
    }

    /**
     * @Given there are following reviewComments:
     *
     * @param TableNode $tableNode
     */
    public function createReviewComments(TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode->getHash() as $reviewCommentsHash) {
            $reviewComments = new ReviewComments();
            $reviewComments->setState($reviewCommentsHash['state']);
            $reviewComments->setComment($reviewCommentsHash['comments']);
            $reviewComments->setArticleReview($this->findReviewComments($reviewCommentsHash['articleReview']));
            $em->persist($reviewComments);
        }
        $em->flush();
    }

    /**
     * @Then I should be on page comments :title
     */
    public function iShouldBeOnNewComments($title)
    {
        $exist = $this->getEntityManager()->getRepository('AppBundle:Article')->findOneBy(array(
            'title' => $title,
        ));

        $review = $this->getEntityManager()->getRepository('AppBundle:ArticleReview')->findOneBy(array(
            'article' => $exist,
        ));

        if (!$exist) {
            throw new ElementNotFoundException('comments doesn\'t exist');
        }

        $this->assertSession()->addressEquals($this->generatePageUrl('comments', array(
            'id' => $review->getId(),
        )));
    }

    /**
     * @Given I am on the comments page :title
     */
    public function iAmOnTheCommentsPage($title)
    {
        $exist = $this->getEntityManager()->getRepository('AppBundle:Article')->findOneBy(array(
            'title' => $title,
        ));

        $review = $this->getEntityManager()->getRepository('AppBundle:ArticleReview')->findOneBy(array(
            'article' => $exist,
        ));

        if (!$exist) {
            throw new ElementNotFoundException('comments doesn\'t exist');
        }

        $this->getSession()->visit($this->generatePageUrl('comments', array(
            'id' => $review->getId(),
        )));
    }

    /**
     * @Then I should be on the new page for :article
     */
    public function iShouldBeOnNewPage($article)
    {
        $exist = $this->getEntityManager()->getRepository('AppBundle:Article')->findOneBy(array(
            'title' => $article,
        ));

        if (!$exist) {
            throw new ElementNotFoundException('article doesn\'t exist');
        }

        $this->assertSession()->addressEquals($this->generatePageUrl('new_article', array(
            'id' => $exist->getId(),
        )));
    }

    /**
     * @Given  I am on the new page for :article
     */
    public function iAmOnTheNewPage($article)
    {
        $exist = $this->getEntityManager()->getRepository('AppBundle:Article')->findOneBy(array(
            'title' => $article,
        ));

        if (!$exist) {
            throw new ElementNotFoundException('article doesn\'t exist');
        }

        $this->getSession()->visit($this->generatePageUrl('new_article', array(
            'id' => $exist->getId(),
        )));
    }
}
