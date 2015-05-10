<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 17/04/15
 * Time: 18:12.
 */

namespace AppBundle\Main\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use AppBundle\Main\Event\StateEndEvent;
use AppBundle\Main\StateEndEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

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
            FormEvents::POST_SUBMIT => array('postSubmit', 4),
            StateEndEvents::SUBMITTED => array('onStateEndSubmitted', 4),
        );
    }

    public function postSubmit(FormEvent $event)
    {
        $article = $event->getData();
        $articleReview = $article->getArticleReviews()->last();
        $comment = $event->getForm()->get('comment')->getData();


    }

    public function onStateEndSubmitted(StateEndEvent $event)
    {
        $articleReview = $event->getArticleReview();
        $this->logger->debug('PRUEBA: Asignado estado final del artículo: '.$articleReview->getArticle()->getTitle());
    }
}
