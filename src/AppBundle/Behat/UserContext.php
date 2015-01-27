<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 27/01/15
 * Time: 18:42
 */

namespace AppBundle\Behat;

use AppBundle\Entity\User;
use Behat\Gherkin\Node\TableNode;


class UserContext extends CoreContext
{
    /**
     * @Given that existing users:
     *
     * @param TableNode $tableNode
     */
    public function createUser(TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode->getHash() as $userHash) {
            $user = new User();
            $user->setUsername($userHash['username']);
            $user->setEmail($userHash['email']);
            $user->setPlainPassword($userHash['plainPassword']);
            $user->setEnabled($userHash['enabled']);
            $em->persist($user);
        }
        $em->flush();
    }
}