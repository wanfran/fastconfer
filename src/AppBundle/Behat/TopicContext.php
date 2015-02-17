<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 15/02/15
 * Time: 19:40
 */

namespace AppBundle\Behat;


use Behat\Gherkin\Node\TableNode;

class TopicContext extends CoreContext
{
    /**
     * @Given there are following topics:
     */
    public function thereAreFollowingTopics(TableNode $tableNode)
    {

    }
}