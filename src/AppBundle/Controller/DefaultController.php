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
     * @Route("/myConferences", name="myConferences")
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

