<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Conference;
use AppBundle\Entity\Document;
use AppBundle\Entity\Inscription;
use AppBundle\Entity\Topic;
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
     * @Route("/")
     */
    public function indexAction()
    {
       $conferences = $this->getDoctrine()->getRepository('AppBundle:Conference')->findAll();

        $securityContext=$this->container->get('security.context');
        if($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $user= $this->get('security.context')->getToken()->getUser();
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

        $word = $request->get('word');
        $em=$this->getDoctrine()->getManager();
        $foundConference= $em->getRepository('AppBundle:Conference')->findConference($word);


        $securityContext=$this->container->get('security.context');
        if($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $user= $this->get('security.context')->getToken()->getUser();
        }
        else
            $user=null;

        return $this->render('Default/index.html.twig', array('user' => $user,'conferences' => $foundConference));
    }


    /**
     * @Route ("/conference/{slug}")
     */

    public function showConference (Conference $conference)
    {

        $user= $this->get('security.token_storage')->getToken()->getUser();

        $em=$this->getDoctrine()->getRepository('AppBundle:Inscription')->findOneBy(array('conference'=>$conference->getId()
        ,'user'=>$user));

        if ($em!=null)
            return $this->render('Default/ConferenceInscription.html.twig', array('conference'=> $conference, 'user'=>$user));

        return $this->render('Default/Conference.html.twig', array('conference'=> $conference,'inscription'=>$em));
    }

    /**
     * @Route("/conference/{slug}/inscription", name="inscription")
     * @param Request $request,Conference $conference
     * @Template()
     */
    public function uploadAction(Request $request,Conference $conference)
    {

        $securityContext=$this->container->get('security.context');

        if($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED'))
        {
            $user= $this->get('security.token_storage')->getToken()->getUser();


            $em=$this->getDoctrine()->getRepository('AppBundle:Inscription')->findOneBy(array('conference'=>$conference->getId()
            ,'user'=>$user));



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


            if( $em==null)
            {
                $inscription = new Inscription();
                $inscription->setConference($conference);
                $inscription->setUser($user);

                $em = $this->getDoctrine()->getManager();
                $em->persist($inscription);
                $em->flush();


            }


            else
            {
                return $this->render('Default/a.html.twig',array('conference'=> $conference));
            }

        }
        else
            $user=null;


     return $this->render('Default/ConferenceInscription.html.twig', array('conference'=> $conference, 'user'=>$user,
         'form' => $form->createView()));

    }


    /**
     * @Route("/articles")
     */
    public function listArticle()
    {
        $articles = $this->getDoctrine()->getRepository('AppBundle:Article')->findAll();

        return $this->render('Default/ListArticles.html.twig', array('articles' => $articles));
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

