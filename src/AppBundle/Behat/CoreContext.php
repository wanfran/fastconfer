<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 8/10/14
 * Time: 9:57
 */

namespace AppBundle\Behat;

use Behat\Behat\Hook\Scope\AfterStepScope;
use Sylius\Bundle\ResourceBundle\Behat\DefaultContext;

class CoreContext extends DefaultContext
{
    /**
     * @AfterStep
     * @param $event
     */
    public function showError(AfterStepScope $event)
    {
        if(!$event->getTestResult()->isPassed()) {
            print "Ruta: " . $this->getSession()->getCurrentUrl() . "\n";
        }
    }

    public function findTopic($topics)
    {
        $topic = $this->getEntityManager()->getRepository('AppBundle:Topic')->findOneBy(array('name'=>$topics));

        return $topic;
    }
}