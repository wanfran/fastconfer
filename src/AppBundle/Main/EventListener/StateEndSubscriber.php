<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 17/04/15
 * Time: 18:12.
 */

namespace AppBundle\Main\EventListener;

use AppBundle\Entity\Article;
use AppBundle\Entity\Author;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Translation\TranslatorInterface;

class StateEndSubscriber implements EventSubscriberInterface
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var EngineInterface
     */
    private $templating;
    /**
     * @var
     */
    private $from;
    /**
     * @var TranslatorInterface
     */
    private $trans;


    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating, TranslatorInterface $trans, $from)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->from = $from;
        $this->trans = $trans;
    }

    public static function getSubscribedEvents()
    {

        return array(
            FormEvents::POST_SUBMIT => array('sendChangeArticleStatusEmail', 1)
        );
    }

    public function sendChangeArticleStatusEmail(FormEvent $event)
    {
        /** @var Article $article */
        $article = $event->getData();
        $articleReview = $article->getArticleReviews()->last();
        $comment = $event->getForm()->get('comment')->getData();

        $to = [$article->getInscription()->getUser()->getEmail()];

        /** @var Author $author */
        foreach($article->getAuthors() as $author) {
            if ($author->isIsNotified()) {
                $to[] = $author->getEmail();
            }
        }

        $message = $this->mailer->createMessage()
            ->setSubject($this->trans->trans('News from %conference%', ['%conference%' => $article->getConference()->getName() ]))
            ->setFrom($this->from)
            ->setTo($to)
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
