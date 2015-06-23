<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/04/15
 * Time: 11:02
 */

namespace AppBundle\EventListener;


use AppBundle\Security\Manager\ConferenceManager;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/***
 * Class CurrentConferenceListener
 * @package AppBundle\EventListener
 * Clase para cambiar la baseHost de la URL por el código de la conferencia
 */
class CurrentConferenceListener
{
    /**
     * @var ConferenceManager
     */
    private $cm;
    /**
     * @var ObjectManager
     */
    private $om;
    private $baseHost;

    function __construct(ConferenceManager $cm, ObjectManager $om, $baseHost )
    {
        $this->cm = $cm;
        $this->om = $om;
        $this->baseHost = $baseHost;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $currentHost = $request->getHost();


        $subdomain = str_replace('.'.$this->baseHost, '', $currentHost);
        if ("www" === $subdomain) {
            return;
        }


        $conference = $this->om
            ->getRepository('AppBundle:Conference')
            ->findOneBy(array('code' => $subdomain))
        ;

        if (!$conference) {
            throw new NotFoundHttpException(sprintf(
                'No site for host "%s", subdomain "%s"',
                $this->baseHost,
                $subdomain
            ));
        }

        $this->cm->setConference($conference);
    }
}