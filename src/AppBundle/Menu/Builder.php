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

        $menu->addChild('All Conferences', array('route' => 'homepage'));

        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        // access services from the container!
        $em = $this->container->get('doctrine')->getManager();

        $inscription = $em->getRepository('AppBundle:Inscription')->findOneBy(array(
            'user' => $user,
        ));

        if ($inscription)
            $menu->addChild('My Conferences',array('route'=> 'myConferences'));




        return $menu;
    }
}