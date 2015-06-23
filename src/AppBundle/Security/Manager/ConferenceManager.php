<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/04/15
 * Time: 10:59
 */

namespace AppBundle\Security\Manager;


use AppBundle\Entity\Conference;

/**
 * Class ConferenceManager
 * @package AppBundle\Security\Manager
 */
class ConferenceManager
{
    /** @var Conference */
    private $conference;

    /**
     * @return Conference
     */
    public function getConference()
    {
        return $this->conference;
    }

    /**
     * @param Conference $conference
     */
    public function setConference( $conference )
    {
        $this->conference = $conference;
    }
}