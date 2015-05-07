<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 17/04/15
 * Time: 18:12.
 */

namespace AppBundle\Main\EventListener;

use AppBundle\Main\TwigMailGenerator;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use AppBundle\Main\Event\StateEndEvent;
use AppBundle\Main\StateEndEvents;

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
            StateEndEvents::SUBMITTED => array('onStateEndSubmitted', 4),
        );
    }

    public function onStateEndSubmitted(StateEndEvent $event)
    {
        $articleReview = $event->getArticleReview();
        $this->logger->debug('PRUEBA: Asignado estado final del artículo: '.$articleReview->getArticle()->getTitle());

        $message = $this->email->createMessage()
            ->setSubject('You have Completed Registration!')
            ->setFrom('send@example.com')
            ->setTo($articleReview->getArticle()->getInscription()->getUser()->getEmail())
            ->setBody('You article have state'.$articleReview->getArticle()->getStateEnd());

        $this->email->send($message);


//        $twig = $this->get('twig');     // Twig_Environment
//        $mailer = $this->get('mailer'); // Swift_Mailer
//
//        $generator = new TwigMailGenerator($twig); // Can be in a DIC
//
//        $message = $generator->getMessage('newsletter', array(
//            'customer' => $articleReview->getArticle()->getInscription()->getUser()
//        ));
//
//        $message = $this->email->createMessage()
//        ->setTo($articleReview->getArticle()->getInscription()->getUser()->getEmail());
//
//        $this->email->send($message);

        $articleReview->notified = true;
    }
}
