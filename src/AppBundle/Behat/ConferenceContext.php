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
     * @param TableNode $tableNode
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
}