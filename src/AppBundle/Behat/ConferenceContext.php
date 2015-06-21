<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 11/01/15
 * Time: 18:07.
 */

namespace AppBundle\Behat;

use AppBundle\Entity\Conference;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Exception\ElementNotFoundException;

class ConferenceContext extends CoreContext
{
    /**
     * @Given there are following conferences:
     */
    public function createConferences(TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode->getHash() as $conferenceHash) {
            $conference = new Conference();
            $conference->setName($conferenceHash['name']);
            $conference->setCity($conferenceHash['city']);
            $conference->setDescription($conferenceHash['description']);
            $conference->setCode($conferenceHash['code']);
            $conference->setUrl($conferenceHash['url']);
            $conference->setImage('null');
            $conference->setMimeType('null');
            $conference->setPath('null');
            $conference->setDateStart(new \DateTime($conferenceHash['dateStart']));
            $conference->setDateEnd(new \DateTime($conferenceHash['dateEnd']));
            $conference->setDeadTime(new \DateTime($conferenceHash['deadTime']));
            $conference->setDateNews(new \DateTime($conferenceHash['dateNews']));
            $conference->addTopic($this->findTopic($conferenceHash['topics']));
            $conference->addChairman($this->findUser($conferenceHash['chairmans']));
            $em->persist($conference);
        }
        $em->flush();
    }

    /**
     * @Then I should see :number conferences
     */
    public function iShouldSeeConferences($number)
    {
        $this->assertSession()->elementsCount('css', 'div.col-lg-6.col-md-12', $number);
    }

    /**
     * @Given I am on the conference page for :name
     */
    public function iAmOnConferencePage($name)
    {
        $conference = $this->getEntityManager()->getRepository('AppBundle:Conference')->findOneByName($name);
        if (!$conference) {
            throw new ElementNotFoundException('Conference doesn\'t exist');
        }

        $this->getSession()->visit($this->generateUrl('conference_show', array('code' => $conference->getCode()),true));
    }

    /**
     * @Then I should be on the conference page for :name
     */
    public function iShouldBeOnConferencePage($name)
    {
        $conference = $this->getEntityManager()->getRepository('AppBundle:Conference')->findOneByName($name);
        if (!$conference) {
            throw new ElementNotFoundException('Conference doesn\'t exist');
        }

        $this->assertSession()->addressEquals($this->generateUrl('conference_show', array('code' => $conference->getCode()
        )));
    }

    /**
     * @Then I should be on new article page for :name
     */
    public function iShouldBeOnNewArticle($name)
    {
        $conference = $this->getEntityManager()->getRepository('AppBundle:Conference')->findOneByName($name);
        if (!$conference) {
            throw new ElementNotFoundException('Conference doesn\'t exist');
        }
        $this->assertSession()->addressEquals($this->generateUrl('article_new', array('code' => $conference->getCode()
        )));
    }
}
