<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 14/04/15
 * Time: 19:26.
 */

namespace AppBundle\Main\Event;

use AppBundle\Entity\Reviewer;
use Symfony\Component\EventDispatcher\Event;

class AssignReviewerEvent extends Event
{
    private $reviewer;

    public function __construct(Reviewer $reviewer)
    {
        $this->reviewer = $reviewer;
    }

    public function getReviewer()
    {
        return $this->reviewer;
    }
}
