<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 15/02/15
 * Time: 19:40.
 */

namespace AppBundle\Behat;

use AppBundle\Entity\Topic;
use Behat\Gherkin\Node\TableNode;

class TopicContext extends CoreContext
{
    /**
     * @Given there are following topics:
     *
     * @param TableNode $tableNode
     */
    public function thereAreFollowingTopics(TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode->getHash() as $topicHash) {
            $topic = new Topic();
            $topic->setName($topicHash['name']);
            $em->persist($topic);
        }
        $em->flush();
    }
}
