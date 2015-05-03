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
        $menu = $factory->createItem('root');
        $menu->setChildrenAttributes(array('class' => 'sidebar-menu'));

        $menu->addChild( $this->container->get('translator')->trans('All Conferences'), array('route' => 'homepage'));


        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        // access services from the container!
        $em = $this->container->get('doctrine')->getManager();

        $inscription = $em->getRepository('AppBundle:Inscription')->findOneBy(array(
            'user' => $user,
        ));

        if ($inscription)
            $menu->addChild($this->container->get('translator')->trans('My Conferences'),array('route'=> 'myConferences'));
        $reviewer = $em->getRepository('AppBundle:Reviewer')->findOneBy(array(
            'user' => $user
        ));

        if($reviewer)
            $menu->addChild($this->container->get('translator')->trans('Assigned Reviews'),array('route'=> 'review_article_list'));


        return $menu;
    }
}