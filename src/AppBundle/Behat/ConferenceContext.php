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

class ConferenceContext extends CoreContext
{
    /**
     * @Given que existen los siguientes congresos:
     *
     *@param TableNode $tableNode
     */
    public function createConferences(TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode->getHash() as $conferenceHash) {
            $conference = new Conference();
            $conference->setName($conferenceHash['name']);
            $conference->setDescription($conferenceHash['description']);
            $em->persist($conference);
        }
        $em->flush();
    }

    /**
     * @Given no hay ningún congreso activo
     */
    public function deleteConferences()
    {
        return true;
    }

    /**
     * @When presiono :button junto a :value

     */

    public function iClickNear($button, $value)
    {
        $tr = $this->assertSession()->elementExists('css', sprintf('table tbody tr:contains("%s")', $value));

        $locator = sprintf('button:contains("%s")', $button);

        if ($tr->has('css', $locator)) {
            $tr->find('css', $locator)->press();
        } else {
            $tr->clickLink($button);
        }

    }

    /**
     * @Then /^debería estar en la página de ([^""]*) con ([^""]*) "([^""]*)"$/
     */
    public function iShouldBeOnPage($page)
    {
        $this->assertSession()->addressEquals($this->generatePageUrl($page));
    }
}