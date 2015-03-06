<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 01/03/15
 * Time: 17:38.
 */

namespace AppBundle\Controller\Frontend;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * Home page.
     *
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $conferences = $this->getDoctrine()->getRepository('AppBundle:Conference');

        $query = $conferences->createQueryBuilder('c')
            ->where('c.dateEnd >= :now')
            ->setParameter('now', new \DateTime())
            ->orderBy('c.name', 'ASC')
            ->getQuery();

        $conferences = $query->getResult();

        return $this->render('Default/index.html.twig', array('conferences' => $conferences));
    }

    /**
     * @Route("/find", name="find")
     */
    public function findConferenceAction(Request $request)
    {
        $word = $request->get('search');

        $em = $this->getDoctrine()->getManager();
        $foundConference = $em->getRepository('AppBundle:Conference')->findConference($word);

        if ($foundConference == null) {
            $this->get('session')->getFlashBag()->set('alert', 'Conference not found');
        }

        return $this->render('Default/index.html.twig', array('conferences' => $foundConference));
    }
}