<?php
namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Article;
use AppBundle\Entity\Conference;
use AppBundle\Entity\Inscription;
use AppBundle\Form\Type\InscriptionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ConferenceController extends Controller
{
    /**
     * @Route ("/conference/{slug}", name="conference")
     */
    public function showConferenceAction(Conference $conference)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $inscription = $this->getDoctrine()->getRepository('AppBundle:Inscription')->findOneBy(array(
            'conference' => $conference->getId(),
            'user' => $user,
        ));

        return $this->render('Conferences/conference.html.twig', array(
            'conference' => $conference,
            'inscription' => $inscription,
        ));
    }

    /**
     * @Route("/conference/{slug}/inscription", name="inscription")
     * @Security("has_role('ROLE_USER')")
     */
    public function inscriptionAction(Conference $conference)
    {
        if ($conference->getDateEnd() < new \DateTime()) {
            $this->get('session')->getFlashBag()->set('alert', 'You can not register for this conference');

            return $this->redirectToRoute('conference', array('slug' => $conference->getSlug()));
        }

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $inscription = $this->getDoctrine()->getRepository('AppBundle:Inscription')->findOneBy(array(
            'conference' => $conference,
            'user' => $user,
        ));

        if ($inscription) {
            $this->get('session')->getFlashBag()->set('alert', 'You can not register again in this conference');

            return $this->redirectToRoute('conference', array('slug' => $conference->getSlug()));
        }

        $inscription = new Inscription();
        $inscription->setConference($conference);
        $inscription->setUser($user);

        $this->getDoctrine()->getManager()->persist($inscription);
        $this->getDoctrine()->getManager()->flush();

        $this->get('session')->getFlashBag()->set('success', 'Congratulations, you are already registered');

        return $this->redirectToRoute('conference', array('slug' => $conference->getSlug()));
    }

    /**
     * @Route("conference/{slug}/upload", name="conference_upload_article")
     * @Security("has_role('ROLE_USER')")
     */
    public function uploadAction(Conference $conference, Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $inscription = $this->getDoctrine()->getRepository('AppBundle:Inscription')->findOneBy(array(
            'conference' => $conference,
            'user' => $user,
        ));

        if (!$inscription) {
            $this->get('session')->getFlashBag()->set('alert', 'You are not registered in this conference');

            return $this->redirectToRoute('conference', array('slug' => $conference->getSlug()));
        }

        $article = new Article();
        $article->setInscriptions($inscription);

        $form = $this->createForm(new InscriptionType(), $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'Your article has been successfully uploaded');

            return $this->redirectToRoute('conference', array('slug' => $conference->getSlug()));
        }

        return $this->render('Conferences/upload.html.twig', array('form' => $form->createView()));
    }
}
