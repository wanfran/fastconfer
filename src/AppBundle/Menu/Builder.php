<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 26/04/15
 * Time: 19:10
 */

namespace AppBundle\Menu;


use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $trans = function($value) { return $this->container->get('translator')->trans($value); };

        $menu = $factory->createItem('root');
        $menu->setChildrenAttributes(array('class' => 'sidebar-menu'));

        $menu->addChild( $trans('All Conferences'), array('route' => 'homepage'));


        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        // access services from the container!
        $em = $this->container->get('doctrine')->getManager();

        $inscription = $em->getRepository('AppBundle:Inscription')->findOneBy(array(
            'user' => $user,
        ));
        if ($inscription) {
            $menu->addChild($trans('My Conferences'), array('route' => 'myConferences'));
        }

        $reviewer = $em->getRepository('AppBundle:Reviewer')->findOneBy(array('user' => $user));
        if($reviewer) {
            $menu->addChild($trans('Assigned Reviews'), array('route'=> 'review_article_list'));
        }

        return $menu;
    }

    public function dashboardMenu(FactoryInterface $factory, array $options)
    {
        $trans = function($value) { return $this->container->get('translator')->trans($value); };

        $menu = $factory->createItem('root');
        $menu->setChildrenAttributes(array('class' => 'sidebar-menu'));

        $conference = $this->container->get('fastconfer.security.conference_manager')->getConference();

        $menu->addChild( $trans('Main page'), array(
            'route' => 'conference_show',
            'routeParameters' => array('code' => $conference->getCode())
        ));

        return $menu;
    }
}