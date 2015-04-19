<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/04/15
 * Time: 11:17
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin as BaseAdmin;

class Admin extends BaseAdmin
{
    public function getService($service)
    {
        return $this->getConfigurationPool()->getContainer()->get($service);
    }

    public function getCurrentConference()
    {
        return $this->getConfigurationPool()->getContainer()->get('fastconfer.security.conference_manager')->getConference();
    }

    public function getRepository($name)
    {
        return $this->getService('doctrine.orm.entity_manager')->getRepository($name);
    }
}