<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 22/04/15
 * Time: 19:34
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;

class Controller extends BaseController
{
    public function getConference()
    {
        return $this->get('fastconfer.security.conference_manager')->getConference();
    }
}