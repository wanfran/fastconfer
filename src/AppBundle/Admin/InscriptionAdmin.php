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

class InscriptionAdmin extends Admin
{


    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
            ->add('conference')
            ->add('user')
        ;
    }

    public function getParentAssociationMapping()
    {
        return 'conference';
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->add('conference')
            ->add('user')



            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'show' => array(),
                )
            ))
        ;
    }

//    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
//    {
//        if (!$childAdmin && !in_array($action, array('edit'))) {
//            return;
//        }
//
//        $admin = $this->isChild() ? $this->getParent() : $this;
//
//        $id = $admin->getRequest()->get('id');
//
//        $menu->addChild(
//            'articles',
//            array('uri' => $admin->generateUrl('fastconfer.admin.article.list', array('id' => $id)))
//        );
//    }

}