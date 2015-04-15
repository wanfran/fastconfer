<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 25/03/15
 * Time: 23:59
 */

namespace AppBundle\Behat;

use AppBundle\ENtity\Article;
use AppBundle\Entity\Reviewer;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Exception\ElementNotFoundException;


class ReviewerContext extends CoreContext
{
    /**
     * @Given there are following reviewer:
     *
     * @param TableNode $tableNode
     */

    public function createReviewer(TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode->getHash() as $reviewerHash)
        {
            $reviewer = new Reviewer();

            $user=$this->getEntityManager()->getRepository('AppBundle:User')->findOneByUsername($reviewerHash['username']);
            $article=$this->getEntityManager()->getRepository('AppBundle:Article')->findOneByTitle($reviewerHash['title']);

            $reviewer->setUser($user);
            $reviewer->setArticle($article);

            $em->persist($reviewer);
        }
        $em->flush();
    }

    /**
     * @Then I should be on page articles reviewer
     */
    public function iShouldBeOnPageArticlesReviewer()
    {
        $user=$this->getSecurityContext()->getToken()->getUser();


        $reviewer = $this->getEntityManager()->getRepository('AppBundle:Reviewer')->findBy(array(
            'user'=>$user
        ));

        if(!$reviewer)
        {
            throw new ElementNotFoundException('Reviewer doesn\'t exist');
        }

        $this->assertSession()->addressEquals($this->generatePageUrl('article_list'));
    }

    /**
     * @Then I should see :number reviewer
     */
    public function iShouldSeeArticles($number)
    {
        $this->assertSession()->elementsCount('css', '.glyphicon-edit', $number);
    }


    /**
     * @Given I am on page articles reviewer
     */
    public function iAmOnPageArticlesReviewer()
    {
        $user=$this->getSecurityContext()->getToken()->getUser();


        $reviewer = $this->getEntityManager()->getRepository('AppBundle:Reviewer')->findBy(array(
            'user'=>$user
        ));

        if(!$reviewer)
        {
            throw new ElementNotFoundException('Reviewer doesn\'t exist');
        }

        $this->getSession()->visit($this->generatePageUrl('article_list'));
    }

    /**
     * @Then I should see on page edit :title
     *
     */
    public function iShouldSeeOnPageEdit($title)
    {

        $user=$this->getSecurityContext()->getToken()->getUser();


        $reviewer = $this->getEntityManager()->getRepository('AppBundle:Reviewer')->findBy(array(
            'user'=>$user
        ));

        if(!$reviewer)
        {
            throw new ElementNotFoundException('Reviewer can\'t edit this article');
        }

        $article =$this->getEntityManager()->getRepository('AppBundle:Article')->findOneBy(array(
            'title'=> $title
        ));

        $this->assertSession()->addressEquals($this->generatePageUrl('article_review',array(
            'id' => $article->getId()
        )));
    }

    /**
     *@Given I am on the edit page :title
     */
    public function iAmOnTheEditPage($title)
    {
        $user=$this->getSecurityContext()->getToken()->getUser();


        $reviewer = $this->getEntityManager()->getRepository('AppBundle:Reviewer')->findBy(array(
            'user'=>$user
        ));

        if(!$reviewer)
        {
            throw new ElementNotFoundException('Reviewer can\'t edit this article');
        }

        $article =$this->getEntityManager()->getRepository('AppBundle:Article')->findOneBy(array(
            'title'=> $title
        ));

        $this->getSession()->visit($this->generatePageUrl('article_review',array(
            'id' => $article->getId()
        )));
    }

}