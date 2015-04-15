<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 14/04/15
 * Time: 19:37
 */

namespace AppBundle\Main\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use AppBundle\Main\Event\AssignEventsReviewer;
use AppBundle\Main\AssignEventsReviewers;

class AssignReviewerSubscriber implements EventSubscriberInterface
{
    private $email;

    public function __construct(\Swift_Mailer $email)
    {
        $this->email = $email;
    }

    public static function getSubscribedEvents()
    {
        return array(
            AssignEventsReviewers::SUBMITTED => array('onReviewerSubmitted', -5)
        );
    }

    public function onReviewerSubmitted(AssignEventsReviewer $event)
    {
        $article = $event->getArticle();
//
//        $mailer = $this->get('mailer');
//        $message = $mailer->createMessage()
//            ->setSubject('You have Completed Registration!')
//            ->setFrom('send@example.com')
//            ->setTo('recipient@example.com')
//            ->setBody(
//                $this->renderView(
//                // app/Resources/views/Emails/registration.html.twig
//                    'Emails/registration.html.twig',
//                    array('name' => $name)
//                ),
//                'text/html'
//            );
//        $mailer->send($message);

        $article->notified = true;
    }

}