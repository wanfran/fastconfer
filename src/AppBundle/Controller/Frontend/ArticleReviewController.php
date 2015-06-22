<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 26/04/15
 * Time: 18:32
 */

namespace AppBundle\Controller\Frontend;


use AppBundle\Controller\Controller;
use AppBundle\Entity\ArticleReview;
use AppBundle\Form\Type\InscriptionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package AppBundle\Controller\Frontend
 * @Route("/article_review", host="{code}.%site_base%", condition="not (context.getHost() matches '/www/')")
 * @Security("has_role('ROLE_USER')")
 */
class ArticleReviewController extends Controller
{
    /**
     * @Route("/{id}", name="article_review_see")
     * @Template("frontend/ArticleReview/show.html.twig")
     */
    public function commentsAction(ArticleReview $articleReview)
    {
        $conference = $this->getConference();
        $user = $this->getUser();

        $exist = $articleReview->getArticle()->getInscription()->getUser();

        if ($user != $exist) {
            $this->addFlash('alert', $this->get('translator')->trans('You can not see other comments'));
            return $this->redirectToRoute('article_list');
        }

        $comments = $this->getDoctrine()->getRepository('AppBundle:ReviewComments')->findBy(array(
            'articleReview' => $articleReview,
        ));

        if ($articleReview->getState() == 'sent') {
            $this->addFlash('alert', $this->get('translator')->trans( 'There are not any comments'));

            return $this->redirectToRoute('article_list');
        }


        return [
            'conference' => $conference,
            'comments' => $comments,
        ];
    }

    /**
     * @Route("/{id}/download", name="article_review_download")
     */
    public function downloadAction(ArticleReview $articleReview)
    {
        $this->denyAccessUnlessGranted('DOWNLOAD', $articleReview);
        $article = $articleReview->getArticle();

        $fileToDownload = $articleReview->getPath();
        $filename = $this->get('slugify')->slugify($article->getTitle())
            . '.' . pathinfo($fileToDownload, PATHINFO_EXTENSION);
        $response = new BinaryFileResponse($fileToDownload);

        $response->trustXSendfileTypeHeader();
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_INLINE, $filename,
            iconv('UTF-8', 'ASCII//TRANSLIT', $filename)
        );

        return $response;
    }
}