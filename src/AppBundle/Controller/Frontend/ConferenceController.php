<?php
namespace AppBundle\Controller\Frontend;

use AppBundle\Controller\Controller;
use AppBundle\Entity\Inscription;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ConferenceController
 * @package AppBundle\Controller\Frontend
 * @Route(host="{code}.%site_base%", condition="not (context.getHost() matches '/www/')")
 */
class ConferenceController extends Controller
{
    /**
     * @Route ("/", name="conference_show")
     * @Template("frontend/Conference/index.html.twig")
     * Función para mostrar los detalles de una conferencia
     */
    public function showAction()
    {
        $conference = $this->getConference();
        $user = $this->getUser();

        $inscription = $this->getDoctrine()->getRepository('AppBundle:Inscription')->findOneBy(array(
            'conference' => $conference->getId(),
            'user' => $user,
        ));

        return [
            "conference" => $conference,
            "inscription" => $inscription,
        ];
    }

    /**
     * @Route("/inscription", name="inscription")
     * @Security("has_role('ROLE_USER')")
     * Función para inscribirse en una conferencia
     */
    public function inscriptionAction()
    {
        $conference = $this->getConference();

        if ($conference->getDateEnd() < new \DateTime()) {
            $this->get('session')->getFlashBag()->set('alert',$this->get('translator')->trans( 'You can not register for this conference'));

            return $this->redirectToRoute('conference_show', ['code' => $conference->getCode()]);
        }

        $user = $this->getUser();
        $inscription = $this->getDoctrine()->getRepository('AppBundle:Inscription')->findOneBy(array(
            'conference' => $conference,
            'user' => $user,
        ));

        if ($inscription) {
            $this->get('session')->getFlashBag()->set('alert', $this->get('translator')->trans( 'You can not register again in this conference'));

            return $this->redirectToRoute('conference_show', ['code' => $conference->getCode()]);
        }

        $inscription = new Inscription();
        $inscription->setConference($conference);
        $inscription->setUser($user);

        $this->getDoctrine()->getManager()->persist($inscription);
        $this->getDoctrine()->getManager()->flush();

        $this->get('session')->getFlashBag()->set('success', $this->get('translator')->trans( 'Congratulations you are already registered'));

        return $this->redirectToRoute('conference_show', ['code' => $conference->getCode()]);
    }
}
