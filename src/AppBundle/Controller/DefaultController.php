<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
       $conferences = $this->getDoctrine()->getRepository('AppBundle:Conference')->findAll();

	    return $this->render('Default/index.html.twig', array('conferences' => $conferences));
    }




    /**
     * @Route("/article")
     */
    public function listArticle()
    {
        $articles = $this->getDoctrine()->getRepository('AppBundle:Article')->findAll();

        return $this->render('Default/a.html.twig', array('articles' => $articles));
    }

    /**
     * @Route("/borrar")
     */
    public function borrar()
    {
        $em=$this->getDoctrine()->getManager();

        foreach ($manager=$em->getRepository('AppBundle:Conference')->findAll() as $resource)
        {
            $em->remove($resource);
        }
        $em->flush();

        $conferences = $this->getDoctrine()->getRepository('AppBundle:Conference')->findAll();

        return $this->render('Default/index.html.twig', array('conferences' => $conferences));
    }


}

