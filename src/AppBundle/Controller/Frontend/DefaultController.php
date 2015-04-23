<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 01/03/15
 * Time: 17:38.
 */

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Reviewer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 * @Route(host="www.%site_base%")
 * @package AppBundle\Controller\Frontend
 */
class DefaultController extends Controller
{
    /**
     * Home page.
     *
     * @Route("/", name="homepage")
     * @Template("frontend/Default/index.html.twig")
     */
    public function indexAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $conferences = $this->getDoctrine()->getRepository('AppBundle:Conference');

        $query = $conferences->createQueryBuilder('c')
            ->where('c.dateEnd >= :now')
            ->setParameter('now', new \DateTime())
            ->orderBy('c.name', 'ASC')
            ->getQuery();

        $conferences = $query->getResult();

        return [
            "conferences" => $conferences,
        ];
    }

    /**
     * @Route("/find", name="find")
     * @Template("frontend/Default/index.html.twig")
     */
    public function findConferenceAction(Request $request)
    {
        $word = $request->get('search');

        $em = $this->getDoctrine()->getManager();
        $conferences = $em->getRepository('AppBundle:Conference')->findConference($word);

        if ($conferences == null) {
            $this->get('session')->getFlashBag()->set('alert', 'Conference not found');
        }

        return [
            "conferences" => $conferences,
        ];
    }
}
