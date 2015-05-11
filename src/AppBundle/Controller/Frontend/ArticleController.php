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
use AppBundle\Form\Type\ArticleType;
use AppBundle\Form\Type\EditArticleType;
use Doctrine\Common\Collections\ArrayCollection;
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
            $this->addFlash('alert', $this->get('translator')->trans( 'You are not registered in this conference'));

            return $this->redirectToRoute('conference_show');
        }

        return [
            'conference' => $conference,
            'inscription' => $inscription,
        ];
    }

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
            $this->addFlash('alert', $this->get('translator')->trans( 'You are not registered in this conference'));

            return $this->redirectToRoute('conference_show');
        }

        $article = new Article();
        $article->setInscription($inscription);

        $form = $this->createForm(new ArticleType(), $article);

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

            $this->addFlash('success', $this->get('translator')->trans( 'Your article has been successfully uploaded'));

            return $this->redirectToRoute('article_list');
        }

        return [
            'conference' => $conference,
            'form' => $form->createView(),
        ];
    }

    /**
     * @param Article $article
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/{id}/edit", name="article_edit")
     * @Template("frontend/Article/edit.html.twig")
     */
    public function editAction(Article $article, Request $request)
    {
        $this->denyAccessUnlessGranted('OWNER', $article);

        // Saving the old authors
        $originalAuthors = new ArrayCollection();
        foreach($article->getAuthors() as $author) {
            $originalAuthors->add($author);
        }


        $form = $this->createForm(new EditArticleType(), $article);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            // remove the relationship between the author and the article
            foreach ($originalAuthors as $author) {
                if (false === $article->getAuthors()->contains($author)) {
                    $em->remove($author);
                }
            }

            $em->persist($article);
            $em->flush();

            $this->addFlash('success', $this->get('translator')->trans('Your article has been successfully updated'));

            return $this->redirectToRoute('article_list');
        }

        return [
            'conference' => $this->getConference(),
            'form' => $form->createView(),
        ];
    }


    /**
     * @Route("/{id}/review/new", name="article_new_review")
     * @Template("frontend/Article/new.html.twig")
     * @Security("is_granted('UPLOAD_NEW_ARTICLE_REVIEW', article)")
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
            $this->addFlash('alert', $this->get('translator')->trans('You are not registered in this conference'));

            return $this->redirectToRoute('conference_show');
        }

        $articles = $this->getDoctrine()->getRepository('AppBundle:Article')->findOneBy(array('id' => $article->getId()));

        $form = $this->createForm(new ArticleType(), $articles);

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

            $this->get('session')->getFlashBag()->set('success', $this->get('translator')->trans( 'Your new article has been successfully send'));

            return $this->redirectToRoute('article_list');
        }

        return [
            'conference' => $conference,
            'form' => $form->createView(),
        ];
    }

}