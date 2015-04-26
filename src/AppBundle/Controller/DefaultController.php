<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Inscription;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DefaultController extends Controller
{
    /**
     * @Route("/myConferences", name="myConferences")
     */
    public function myConferencesAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $inscription = $this->getDoctrine()->getRepository('AppBundle:Inscription')->findBy(array('user' => $user));

        $securityContext = $this->container->get('security.context');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
        } else {
            $user = null;
        }

        return $this->render('Default/ListConferences.html.twig', array('inscription' => $inscription));
    }
}
