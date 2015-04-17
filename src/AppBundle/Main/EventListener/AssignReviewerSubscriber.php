<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 14/04/15
 * Time: 19:37
 */

namespace AppBundle\Main\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use AppBundle\Main\Event\AssignReviewerEvent;
use AppBundle\Main\AssignReviewerEvents;
use Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle;
use AppBundle\Entity\User;

class AssignReviewerSubscriber implements EventSubscriberInterface
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
            AssignReviewerEvents::SUBMITTED => array('onReviewerSubmitted', 5)
        );
    }

    public function onReviewerSubmitted(AssignReviewerEvent $event)
    {
        $article = $event->getArticle();

        $this->logger->debug('FASTCONFER: Asignado revisores a artículo: ' . $article->getTitle() );

//        $mailer = $this->get('mailer');
//        $message = $mailer->createMessage()
//            ->setSubject('You have Completed Registration!')
//            ->setFrom('send@example.com')
//            ->setTo($article->getInscription()->getUser()->getEmail())
//            ->setBody('My <em>amazing</em> body',
//                'text/html'
//            );
//        $mailer->send($message);
//
//        $article->notified = true;
    }

}