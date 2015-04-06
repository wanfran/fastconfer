<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 5/04/15
 * Time: 18:36
 */

namespace AppBundle\Admin;

use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Admin\Admin;

class ConferenceAdmin extends Admin {


    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('description')
            ->add('dateStart','sonata_type_datetime_picker',array(
                'format'=>'dd MMMM YY'
            ))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('description')
            ->add('dateStart','date', array(
                    'label' => 'label.dateStart',
                    'pattern' => 'dd MMMM Y',
                    'locale' => 'es',
                    'timezone' => 'Europe/Madrid',
            ))
            ->add('dateEnd','date', array(
                'label' => 'label.dateEnd',
                'pattern' => 'dd MMMM YY',
                'locale' => 'es',
                'timezone' => 'Europe/Madrid',
            ))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                )
            ))
        ;
    }

    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if (!$childAdmin && !in_array($action, array('edit'))) {
            return;
        }

        $admin = $this->isChild() ? $this->getParent() : $this;

        $id = $admin->getRequest()->get('id');

        $menu->addChild(
            'inscriptions',
            array('uri' => $admin->generateUrl('fastconfer.admin.inscription.list', array('id' => $id)))
        );
    }


}
