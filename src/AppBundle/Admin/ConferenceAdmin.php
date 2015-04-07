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
use Sonata\AdminBundle\Show\ShowMapper;

class ConferenceAdmin extends Admin {


    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('description')
            ->add('image')
            ->add('slug')
            ->add('dateStart','sonata_type_datetime_picker',array(
                'format'=>'dd MMMM YY'
            ))
            ->add('dateEnd','sonata_type_datetime_picker',array(
                'format'=>'dd MMMM YY'
            ))
            ->add('deadTime','sonata_type_datetime_picker',array(
                'format'=>'dd MMMM YY'
            ))
            ->add('topics')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name')
            ->add('description')
            ->add('image')
            ->add('slug')
            ->add('dateStart')
            ->add('dateEnd')
            ->add('deadTime')
            ->add('topics')
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
            ->add('name')
            ->add('dateStart','date', array(
                    'label' => 'Date Start',
                    'pattern' => 'dd MMMM Y',
                    'locale' => 'es',
                    'timezone' => 'Europe/Madrid',
            ))
            ->add('dateEnd','date', array(
                'label' => 'Date End',
                'pattern' => 'dd MMMM YY',
                'locale' => 'es',
                'timezone' => 'Europe/Madrid',
            ))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'show' => array(),
                )))
        ;
    }

    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if (!$childAdmin && !in_array($action, array('edit','show'))) {
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
