<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Conference;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
       $conferences = $this->getDoctrine()->getRepository('AppBundle:Conference')->findAll();

        $securityContext=$this->container->get('security.context');
        if($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $usuario= $this->get('security.context')->getToken()->getUser();
        }
        else
            $usuario=null;

	    return $this->render('Default/index.html.twig', array('usuario' => $usuario));
    }

    /**
     * @Route("/conferences")
     */
    public function listConference()
    {
        $conferences = $this->getDoctrine()->getRepository('AppBundle:Conference')->findAll();


        return $this->render('Default/ListConferences.html.twig', array('conferences' => $conferences));
    }

    /**
     * @Route ("/conference/{slug}")
     */

    public function showConference (Conference $conference)
    {



        return $this->render('Default/Conference.html.twig', array('conference'=> $conference));

    }


    /**
     * @Route("/conference/{slug}/inscription")
     */
    public function inscription(Conference $conference)
    {
        $securityContext=$this->container->get('security.context');

        if($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $usuario= $this->get('security.context')->getToken()->getUser();
        }
        else
            $usuario=null;


        return $this->render('Default/Inscription.html.twig', array('conference' => $conference, 'user'=>$usuario ));
    }


    /**
     * @Route("/ayuda")
     */
    public function ayudaAction()
    {
        return new Response('Ayuda');
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


}

