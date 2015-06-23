<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 19/04/15
 * Time: 20:35
 */

namespace AppBundle\Controller\Backend;


use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleReview;
use AppBundle\Main\Event\StateEndEvent;
use AppBundle\Main\StateEndEvents;
use Sonata\AdminBundle\Controller\CRUDController;

/**
 * Class ArticleReviewController
 * @package AppBundle\Controller\Backend
 * Funciones para los estados del artículo
 */
class ArticleReviewController extends CRUDController
{
    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * Función para cambiar el estado de un artículo a "Aceptado"
     */
    public function acceptedAction()
    {
        /** @var ArticleReview $object */
        $object = $this->admin->getSubject();
        if (!$object) {
            throw $this->createNotFoundException(sprintf('Error with accepted'));
        }

        $event = new StateEndEvent($object);
        $event = $this->container->get('event_dispatcher')->dispatch(StateEndEvents::SUBMITTED, $event);

        $object->setState(Article::STATUS_ACCEPTED);
        $object->getArticle()->setStateEnd(Article::STATUS_ACCEPTED);
        $this->getDoctrine()->getManager()->persist($object);
        $this->getDoctrine()->getManager()->flush();


        return $this->redirectToRoute('admin_app_article_show', array(
            'id' => $object->getArticle()->getId(),
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * Función para cambiar el estado de un artículo a "Rechazado"
     */
    public function rejectedAction()
    {
        $object = $this->admin->getSubject();

        if (!$object)
        {
            throw $this->createNotFoundException(sprintf('Error with rejected'));
        }

        $event = new StateEndEvent($object);
        $event = $this->container->get('event_dispatcher')->dispatch(StateEndEvents::SUBMITTED, $event);

        $object->setState(Article::STATUS_REJECTED);
        $object->getArticle()->setStateEnd(Article::STATUS_REJECTED);
        $this->getDoctrine()->getManager()->persist($object);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('admin_app_article_show',array(
            'id' => $object->getArticle()->getId()
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * Función para cambiar el estado de un artículo a "Aceptado con Sugerencias"
     */
    public function acceptedWithSuggestionsAction()
    {
        $object = $this->admin->getSubject();

        $event = new StateEndEvent($object);
        $event = $this->container->get('event_dispatcher')->dispatch(StateEndEvents::SUBMITTED, $event);

        if(!$object)
        {
            throw $this->createNotFoundException(sprintf('Error with accepted with suggestions'));
        }

        $object->setState(Article::STATUS_ACCEPTED_SUGGESTIONS);
        $object->getArticle()->setStateEnd(Article::STATUS_ACCEPTED_SUGGESTIONS);
        $this->getDoctrine()->getManager()->persist($object);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('admin_app_article_show',array(
            'id' => $object->getArticle()->getId()
        ));
    }
}