<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 24/02/15
 * Time: 19:37.
 */

namespace AppBundle\Behat;

use AppBundle\Entity\User;
use AppBundle\Entity\Inscription;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Exception\ElementNotFoundException;

class InscriptionContext extends CoreContext
{
    /**
     *@Given there are following inscriptions:
     *
     *@param TableNode $tableNode
     */
    public function createInscription($tableNode)
    {
        $em = $this->getEntityManager();

        foreach ($tableNode->getHash() as $inscriptionHash) {
            $inscription = new Inscription();

            $user = $this->getEntityManager()->getRepository('AppBundle:User')->findOneByUsername($inscriptionHash['username']);
            $conference = $this->getEntityManager()->getRepository('AppBundle:Conference')->findOneByName($inscriptionHash['name']);

            $inscription->setUser($user);
            $inscription->setConference($conference);

            $em->persist($inscription);
        }
        $em->flush();
    }

    /**
     * @Given I am on the inscription page for :name
     */
    public function iAmOnInscriptionPage($name)
    {
        $user = $this->getSecurityContext()->getToken()->getUser();

        $conference = $this->getEntityManager()->getRepository('AppBundle:Conference')->findOneBy(array(
            'name' => $name,
        ));

        $inscription = $this->getEntityManager()->getRepository('AppBundle:Inscription')->findOneBy(array(
            'conference' => $conference,
        'user' => $user,
        ));

        if (!$inscription) {
            throw new ElementNotFoundException('Inscription doesn\'t exist');
        }

        $this->getSession()->visit($this->generatePageUrl('inscription', array(
            'slug' => $inscription->getConference()->getSlug(),
        )));
    }

    /**
     *@Then I should be on the upload page for :name
     */
    public function iShouldBeOnUploadPage($name)
    {
        $user = $this->getSecurityContext()->getToken()->getUser();

        $conference = $this->getEntityManager()->getRepository('AppBundle:Conference')->findOneBy(array(
            'name' => $name,
        ));

        $inscription = $this->getEntityManager()->getRepository('AppBundle:Inscription')->findOneBy(array(
            'conference' => $conference,
            'user' => $user,
        ));

        if (!$inscription) {
            throw new ElementNotFoundException('Inscription doesn\'t exist');
        }

        $this->assertSession()->addressEquals($this->generatePageUrl('conference_upload_article', array(
            'slug' => $inscription->getConference()->getSlug(),
        )));
    }

    /**
     * @Given I am on the upload page for :name
     */
    public function iAmOnUploadPage($name)
    {
        $user = $this->getSecurityContext()->getToken()->getUser();

        $conference = $this->getEntityManager()->getRepository('AppBundle:Conference')->findOneBy(array(
            'name' => $name,
        ));

        $inscription = $this->getEntityManager()->getRepository('AppBundle:Inscription')->findOneBy(array(
            'conference' => $conference,
            'user' => $user,
        ));

        if (!$inscription) {
            throw new ElementNotFoundException('Inscription doesn\'t exist');
        }

        $this->getSession()->visit($this->generatePageUrl('conference_upload_article', array(
            'slug' => $inscription->getConference()->getSlug(),
        )));
    }
}
