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
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Templating\EngineInterface;

class StateEndSubscriber implements EventSubscriberInterface
{
    private $mailer;

    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var EngineInterface
     */
    private $templating;


    public function __construct(\Swift_Mailer $mailer, LoggerInterface $logger, EngineInterface $templating)
    {
        $this->mailer = $mailer;
        $this->logger = $logger;
        $this->templating = $templating;
    }

    public static function getSubscribedEvents()
    {

        return array(
            FormEvents::POST_SUBMIT => array('postSubmit', 1)
        );
    }

    public function postSubmit(FormEvent $event)
    {

        $article = $event->getData();
        $articleReview = $article->getArticleReviews()->last();
        $comment = $event->getForm()->get('comment')->getData();

        $message = $this->mailer->createMessage()
            ->setSubject('You have Completed Registration!')
            ->setFrom('send@example.com')
            ->setTo($article->getInscription()->getUser()->getEmail())
            ->setBody(
                $this->templating->render(
                    'email/stateEndArticle.html.twig',
                    array(
                        'article' => $article,
                        'comment' => $comment,
                    )
                )
            );

        $this->mailer->send($message);

        $articleReview->setState($article->getStateEnd());
    }
}
