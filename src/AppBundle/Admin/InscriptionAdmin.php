<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 5/04/15
 * Time: 20:03
 */

namespace AppBundle\Admin;

use Knp\Menu\ItemInterface as MenuItemInterface;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class InscriptionAdmin extends Admin
{


    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('conference')
            ->add('user')

        ;
    }


    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('conference')
            ->add('user')
            ->add('createdAt')
        ;
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->add('user')
            ->add('createdAt')
        ;
    }

    public function getParentAssociationMapping()
    {
        return 'conference';
    }


    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if (!$childAdmin && !in_array($action, array('show'))) {
            return;
        }

        $admin = $this->isChild() ? $this->getParent() : $this;

        $id = $admin->getRequest()->get('id');

        $menu->addChild(
            'List Inscriptions',
            array('uri' => $admin->generateUrl('fastconfer.admin.inscription.list', array('id' => $id)))
        );



    }

}