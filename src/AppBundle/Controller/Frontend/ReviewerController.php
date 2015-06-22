<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 23/03/15
 * Time: 17:16.
 */

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleReview;
use AppBundle\Entity\ReviewComments;
use AppBundle\Entity\Reviewer;
use AppBundle\Form\Type\ReviewerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ReviewerController
 * @package AppBundle\Controller\Frontend
 * @Security("has_role('ROLE_USER')")
 * @Route(host="www.%site_base%")
 *
 */
class ReviewerController extends Controller
{
    /**
     * @Route ("/reviewer/article", name="review_article_list")
     * @Template("frontend/reviewer/listArticle.html.twig")
     */
    public function listArticleAction()
    {
        $user = $this->getUser();

        $assignations = $this->getDoctrine()->getRepository('AppBundle:Reviewer')->findBy(array(
            'user' => $user,
        ));

        if (!$assignations) {
            $this->addFlash('alert',$this->get('translator')->trans( 'You are not a review'));

            return $this->redirectToRoute('homepage');
        }

        return [
            'assignations' => $assignations,
        ];
    }


    /**
     * @Route ("/reviewer/article/{id}/show", name="article_review_show")
     * @Template("frontend/reviewer/article_show.html.twig")
     */
    public function showReviewArticle(Article $article)
    {


        $reviewer = $this->getDoctrine()->getRepository('AppBundle:Reviewer')->findOneBy(['user' => $this->getUser(), 'article' => $article]);

        $this->denyAccessUnlessGranted('SHOW', $reviewer);

        return [
            'comments' => $reviewer->getReviewComments(),
        ];
    }


    /**
     * @Route ("/reviewer/article/{id}", name="article_review")
     * @Template("frontend/reviewer/Article.html.twig")
     */
    public function reviewArticle(Article $article, Request $request)
    {
        $this->denyAccessUnlessGranted('CREATE', $article);

        $user = $this->getUser();

        $findArticle = $this->getDoctrine()->getRepository('AppBundle:Reviewer')->findOneBy(array(
            'user' => $user,
            'article' => $article,
        ));

        if (!$findArticle) {
            $this->addFlash('alert',$this->get('translator')->trans( 'You are not a review'));

            return $this->redirectToRoute('homepage');
        }

        $review_article = $this->getDoctrine()->getRepository('AppBundle:ArticleReview')->findOneBy(array(
            'article' => $article,
        ));

        $reviewComments = new ReviewComments();

        $reviewComments->setReviewer($findArticle);
        $reviewComments->setArticleReview($review_article);

        $form = $this->createForm(new ReviewerType(), $reviewComments);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reviewComments);
            $em->flush();

            $this->addFlash('success',$this->get('translator')->trans( 'Your comment has been successfully edited'));

            return $this->redirectToRoute('review_article_list');
        }

        return [
            'review' => $findArticle,
            'form' => $form->createView()
        ];
    }


}
