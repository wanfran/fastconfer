<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 22/04/15
 * Time: 19:34
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;

/**
 * Class Controller
 * @package AppBundle\Controller
 */
class Controller extends BaseController
{
    /**
     * @return \AppBundle\Entity\Conference
     * Función para obtener todas las conferencias
     */
    public function getConference()
    {
        return $this->get('fastconfer.security.conference_manager')->getConference();
    }
}