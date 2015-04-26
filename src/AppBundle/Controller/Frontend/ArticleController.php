<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 26/04/15
 * Time: 17:52
 */

namespace AppBundle\Controller\Frontend;


use AppBundle\Controller\Controller;
use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleReview;
use AppBundle\Form\Type\InscriptionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ConferenceController
 * @package AppBundle\Controller\Frontend
 * @Route("/article", condition="not (context.getHost() matches '/www/')")
 * @Security("has_role('ROLE_USER')")
 */
class ArticleController extends Controller
{
    /**
     * @Route("/new", name="article_new")
     * @Template("frontend/Article/new.html.twig")
     */
    public function newAction(Request $request)
    {
        $user = $this->getUser();
        $conference = $this->getConference();

        $inscription = $this->getDoctrine()->getRepository('AppBundle:Inscription')->findOneBy(array(
            'conference' => $conference,
            'user' => $user,
        ));

        if (!$inscription) {
            $this->addFlash('alert', 'You are not registered in this conference');

            return $this->redirectToRoute('conference_show');
        }

        $article = new Article();
        $article->setInscription($inscription);

        $form = $this->createForm(new InscriptionType(), $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            $article_review = new ArticleReview();
            $article_review->setArticle($article);

            $article_review->setPath($form->get('path')->getData());

            $em = $this->getDoctrine()->getManager();
            $em->persist($article_review);

            $uploadableManager = $this->get('stof_doctrine_extensions.uploadable.manager');
            $uploadableManager->markEntityToUpload($article_review, $article_review->getPath());

            $em->flush();

            $this->addFlash('success', 'Your article has been successfully uploaded');

            return $this->redirectToRoute('conference_show');
        }

        return [
            'conference' => $conference,
            'form' => $form->createView(),
        ];
    }


    /**
     * @Route("/{id}/review/new", name="article_new_review")
     * @Security("has_role('ROLE_USER')")
     * @Template("frontend/Article/new.html.twig")
     */
    public function newReviewAction(Article $article, Request $request)
    {
        $conference = $article->getInscription()->getConference();
        $user = $this->getUser();

        $inscription = $this->getDoctrine()->getRepository('AppBundle:Inscription')->findOneBy(array(
            'conference' => $conference,
            'user' => $user,
        ));

        if (!$inscription) {
            $this->addFlash('alert', 'You are not registered in this conference');

            return $this->redirectToRoute('conference_show');
        }

        $articles = $this->getDoctrine()->getRepository('AppBundle:Article')->findOneBy(array('id' => $article->getId()));

        $form = $this->createForm(new InscriptionType(), $articles);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            $article_review = new ArticleReview();
            $article_review->setArticle($article);
            $article_review->setPath($form->get('path')->getData());

            $em = $this->getDoctrine()->getManager();
            $em->persist($article_review);

            $uploadableManager = $this->get('stof_doctrine_extensions.uploadable.manager');
            $uploadableManager->markEntityToUpload($article_review, $article_review->getPath());

            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'Your new article has been successfully send');

            return $this->redirectToRoute('conference_show');
        }

        return [
            'conference' => $conference,
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/list", name="article_list")
     * @Template("frontend/Article/list.html.twig")
     */
    public function listAction()
    {
        $conference = $this->getConference();
        $user = $this->getUser();

        $inscription = $this->getDoctrine()->getRepository('AppBundle:Inscription')->findOneBy(array(
            'conference' => $conference,
            'user' => $user,
        ));

        if (!$inscription) {
            $this->addFlash('alert', 'You are not registered in this conference');

            return $this->redirectToRoute('conference_show');
        }

        return [
            'conference' => $conference,
            'inscription' => $inscription,
        ];
    }

}