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
}
