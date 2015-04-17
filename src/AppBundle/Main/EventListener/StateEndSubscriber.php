<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 17/04/15
 * Time: 18:12
 */

namespace AppBundle\Main\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use AppBundle\Main\Event\StateEndEvent;
use AppBundle\Main\StateEndEvents;
use Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle;
use AppBundle\Entity\User;

class StateEndSubscriber implements EventSubscriberInterface
{
    private $email;

    /**
     * @var LoggerInterface
     */
    private $logger;


    public function __construct(\Swift_Mailer $email, LoggerInterface $logger)
    {
        $this->email = $email;
        $this->logger = $logger;
    }

    public static function getSubscribedEvents()
    {
        return array(
            StateEndEvents::SUBMITTED => array('onStateEndSubmitted', 4)
        );
    }

    public function onStateEndSubmitted(StateEndEvent $event)
    {
        $article = $event->getArticle();
        $this->logger->debug('PRUEBA: Asignado estado final del artículo: ' . $article->getTitle());
    }

}