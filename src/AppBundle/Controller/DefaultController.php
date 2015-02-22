<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Conference;
use AppBundle\Entity\Document;
use AppBundle\Entity\Inscription;
use AppBundle\Entity\Topic;
use AppBundle\Entity\Article;
use AppBundle\Form\Type\InscriptionType;
use Faker\Provider\cs_CZ\DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class DefaultController extends Controller
{
    /**
     *
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
       $conferences = $this->getDoctrine()->getRepository('AppBundle:Conference')->findAll();

        $securityContext=$this->container->get('security.context');
        if($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $user= $this->get('security.context')->getToken()->getUser();
            $this->get('session')->getFlashBag()->set('success', 'You are be connected to the system ');
        }
        else
            $user=null;

	    return $this->render('Default/index.html.twig', array('user' => $user,'conferences' => $conferences));
    }


    /**
     * @Route("/find", name="find")
     *
     */
    public function findConferenceAction(Request $request)
    {

        $word = $request->get('search');
        $em=$this->getDoctrine()->getManager();
        $foundConference= $em->getRepository('AppBundle:Conference')->findConference($word);


        $securityContext=$this->container->get('security.context');
        if($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $user= $this->get('security.context')->getToken()->getUser();
        }
        else
            $user=null;

        if($foundConference==null) {
            $this->get('session')->getFlashBag()->set('alert', 'Conference not found');

        }

        return $this->render('Default/index.html.twig', array('user' => $user,'conferences' => $foundConference));
    }

    /**
     * @Route ("/conference/{slug}", name="conference")
     */
    public function showConferenceAction (Conference $conference)
    {

        $user= $this->get('security.token_storage')->getToken()->getUser();

        $em=$this->getDoctrine()->getRepository('AppBundle:Inscription')->findOneBy(array('conference'=>$conference->getId()
        ,'user'=>$user));

        return $this->render('Default/Conference.html.twig', array('conference'=> $conference,'inscription'=>$em));
    }

    /**
     * @Route("/conference/{slug}/inscription", name="inscription")
     * @param Conference $conference
     * @Template()
     */
    public function inscriptionAction(Conference $conference)
    {

        $securityContext=$this->container->get('security.context');

        if($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED'))
        {
            $user= $this->get('security.token_storage')->getToken()->getUser();


            $em=$this->getDoctrine()->getRepository('AppBundle:Inscription')->findOneBy(array('conference'=>$conference->getId()
            ,'user'=>$user));

            if($conference->getDateEnd()->format('Y-m-d')<date("Y-m-d"))
            {
                $this->get('session')->getFlashBag()->set('alert', 'You can not register for this conference');
                return $this->redirectToRoute('conference',array('slug' => $conference->getSlug()));
            }
            else
            {

                if( $em==null)
                {
                    $inscription = new Inscription();
                    $inscription->setConference($conference);
                    $inscription->setUser($user);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($inscription);
                    $em->flush();


                    $this->get('session')->getFlashBag()->set('success', 'Congratulations, you are already registered');
                }
//                else {
//                    $this->get('session')->getFlashBag()->set('alert', 'You can not register again in this conference');
//                    return $this->redirectToRoute('conference', array('slug' => $conference->getSlug()));
//                }
            }
        }
        else
            $user=null;

     return $this->render('Default/ConferenceInscription.html.twig', array('conference'=> $conference, 'user'=>$user));

    }


    /**
     * @Route("inscription/{id}/upload", name="upload")
     * @param Inscription $inscription,Request $request
     * @Template()
     */
    public function uploadAction(Inscription $inscription, Request $request)
    {
        $article = new Article();
        $article->setInscriptions($inscription);



        $form = $this->createForm(new InscriptionType(), $article);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'Tu articulo se ha subido correctamente');

            return $this->redirect($this->generateUrl(
                'inscription',
                array('id' => $article->getId())
            ));
        }

        return $this->render('Default/Upload.html.twig',array('form'=>$form->createView()));

    }


    /**
     * @Route("/MyConferences", name="MyConferences")
     */
    public function myConferencesAction()
    {

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $inscription = $this->getDoctrine()->getRepository('AppBundle:Inscription')->findBy(array('user'=>$user));


        $securityContext=$this->container->get('security.context');
        if($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {

        }
        else
            $user = null;

        return $this->render('Default/ListConferences.html.twig', array('inscription' => $inscription));

    }


    /**
     * @Route("/delete")
     */
    public function deleteConferece()
    {
        $em=$this->getDoctrine()->getManager();

        foreach ($manager=$em->getRepository('AppBundle:Conference')->findAll() as $resource)
        {
            $em->remove($resource);
        }
        $em->flush();

        return $this->render('Default/ListConferences.html.twig', array('conferences' => $manager));
    }

    /**
     *
     * @Route("/conference/{slug}/a")
     *@param Request $request,Conference $conference
     * @Template()
     */
    public function suploadAction(Request $request,Conference $conference)
    {

        $securityContext=$this->container->get('security.context');

        if($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $user= $this->get('security.context')->getToken()->getUser();
        }
        else
            $user=null;

        $document = new Document();
        $form = $this->createFormBuilder($document)
            ->add('name')
            ->add('file')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

           $document->upload();

            $em->persist($document);
            $em->flush();

            return $this->redirect($this->generateUrl('listArticles'));
        }

        return $this->render('Default/Inscription.html.twig', array('conference' => $conference,
            'user'=>$user,
            'form' => $form->createView()));
    }
}

