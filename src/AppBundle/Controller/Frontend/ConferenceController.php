<?php
namespace AppBundle\Controller\Frontend;

use AppBundle\Controller\Controller;
use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleReview;
use AppBundle\Entity\Conference;
use AppBundle\Entity\Inscription;
use AppBundle\Form\Type\InscriptionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ConferenceController
 * @package AppBundle\Controller\Frontend
 * @Route(condition="not (context.getHost() matches '/www/')")
 */
class ConferenceController extends Controller
{
    /**
     * @Route ("/", name="conference_show")
     * @Template("frontend/Conference/index.html.twig")
     */
    public function showAction()
    {
        $conference = $this->getConference();
        $user = $this->getUser();

        $inscription = $this->getDoctrine()->getRepository('AppBundle:Inscription')->findOneBy(array(
            'conference' => $conference->getId(),
            'user' => $user,
        ));

        return [
            "conference" => $conference,
            "inscription" => $inscription,
        ];
    }

    /**
     * @Route("/conference/{slug}/inscription", name="inscription")
     * @Security("has_role('ROLE_USER')")
     *
     */
    public function inscriptionAction(Conference $conference)
    {
        if ($conference->getDateEnd() < new \DateTime()) {
            $this->get('session')->getFlashBag()->set('alert', 'You can not register for this conference');

            return $this->redirectToRoute('conference_show');
        }

        $user = $this->getUser();
        $inscription = $this->getDoctrine()->getRepository('AppBundle:Inscription')->findOneBy(array(
            'conference' => $conference,
            'user' => $user,
        ));

        if ($inscription) {
            $this->get('session')->getFlashBag()->set('alert', 'You can not register again in this conference');

            return $this->redirectToRoute('conference_show');
        }

        $inscription = new Inscription();
        $inscription->setConference($conference);
        $inscription->setUser($user);

        $this->getDoctrine()->getManager()->persist($inscription);
        $this->getDoctrine()->getManager()->flush();

        $this->get('session')->getFlashBag()->set('success', 'Congratulations, you are already registered');

        return $this->redirectToRoute('conference_show');
    }

    /**
     * @Route("conference/{slug}/upload", name="conference_upload_article")
     * @Security("has_role('ROLE_USER')")
     * @Template("frontend/Conference/index.html.twig")
     */
    public function uploadAction(Conference $conference, Request $request)
    {
        $user = $this->getUser();

        $inscription = $this->getDoctrine()->getRepository('AppBundle:Inscription')->findOneBy(array(
            'conference' => $conference,
            'user' => $user,
        ));

        if (!$inscription) {
            $this->get('session')->getFlashBag()->set('alert', 'You are not registered in this conference');

            return $this->redirectToRoute('conference', array('slug' => $conference->getSlug()));
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

            $this->get('session')->getFlashBag()->set('success', 'Your article has been successfully uploaded');

            return $this->redirectToRoute('conference_show');
        }

        return $this->render('frontend/Conference/upload.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("conference/new/{id}", name="new_article")
     * @Security("has_role('ROLE_USER')")
     *
     */
    public function newArticleAction(Article $article, Request $request)
    {
        $conference = $article->getInscription()->getConference();
        $user = $this->getUser();

        $inscription = $this->getDoctrine()->getRepository('AppBundle:Inscription')->findOneBy(array(
            'conference' => $conference,
            'user' => $user,
        ));

        if (!$inscription) {
            $this->get('session')->getFlashBag()->set('alert', 'You are not registered in this conference');

            return $this->redirectToRoute('conference', array('slug' => $conference->getSlug()));
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

        return $this->render('frontend/Conference/upload.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("comments/{id}", name="comments")
     * @Security("has_role('ROLE_USER')")
     */
    public function commentsAction(ArticleReview $articleReview)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $exist = $articleReview->getArticle()->getInscription()->getUser();

        if ($user != $exist) {
            $this->get('session')->getFlashBag()->set('alert', 'You can not see other comments');

            return $this->redirectToRoute('conference', array('slug' => $articleReview->getArticle()
                ->getInscription()->getConference()->getSlug(),
            ));
        }

        $comments = $this->getDoctrine()->getRepository('AppBundle:ReviewComments')->findBy(array(
            'articleReview' => $articleReview,
        ));

        if ($articleReview->getState() == 'send') {
            $this->get('session')->getFlashBag()->set('alert', 'There are not any comments');

            return $this->redirectToRoute('conference', array('slug' => $articleReview->getArticle()
                ->getInscription()->getConference()->getSlug(),
            ));
        }

        $this->get('session')->getFlashBag()->set('success', 'There is some comments');

        return $this->render('Conferences/comments.html.twig', array('comments' => $comments));
    }
}
