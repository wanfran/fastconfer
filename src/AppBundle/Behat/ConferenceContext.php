<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 11/01/15
 * Time: 18:07
 */

namespace AppBundle\Behat;


use AppBundle\Entity\Conference;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Exception\ElementNotFoundException;

class ConferenceContext extends CoreContext
{
    /**
     * @Given there are following conferences:
     *
     * @param TableNode $tableNode
     */
    public function createConferences(TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode->getHash() as $conferenceHash) {
            $conference = new Conference();
            $conference->setName($conferenceHash['name']);
            $conference->setDescription($conferenceHash['description']);
            $conference->setSlug($conferenceHash['slug']);
            $conference->setImage('null');
            $conference->setDateStart(new \DateTime($conferenceHash['registration_starts_at']));
            $conference->setDateEnd(new \DateTime($conferenceHash['registration_ends_at']));
            $conference->setDeadTime(new \DateTime($conferenceHash['dead_time']));
            $em->persist($conference);
        }
        $em->flush();
    }

    /**
     * @Then I should see :number conferences
     */
    public function iShouldSeeConferences($number)
    {
        $this->assertSession()->elementsCount('css', '.card', $number);
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

        $this->getSession()->visit($this->generatePageUrl('conference', array('slug' => $conference->getSlug())));
    }

    /**
     * @Then I should be on the conference page for :name
     *
     */
    public function iShouldBeOnConferencePage($name)
    {
        $conference = $this->getEntityManager()->getRepository('AppBundle:Conference')->findOneByName($name);
        if (!$conference) {
            throw new ElementNotFoundException('Conference doesn\'t exist');
        }

        $this->assertSession()->addressEquals($this->generatePageUrl('conference', array('slug' => $conference->getSlug())));
    }

}