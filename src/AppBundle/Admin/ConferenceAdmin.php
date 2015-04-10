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


use Sonata\AdminBundle\Route\RouteCollection;

class ConferenceAdmin extends Admin {


    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name','textarea')
            ->add('description','textarea')
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
                    'list' => array(
                        'template' => 'Organization/CRUD/list__action_list_inscriptions.html.twig'
                    ),
                    'edit' => array(),
                    'show' => array(),
                )))
        ;
    }


    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('clone', $this->getRouterIdParameter().'/clone');
    }


    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if (!$childAdmin && !in_array($action, array('show'))) {
            return;
        }

        $admin = $this->isChild() ? $this->getParent() : $this;

        $id = $admin->getRequest()->get('id');

        $menu->addChild(
            'List Conferences',
            array('uri' => $admin->generateUrl('fastconfer.admin.conference.list', array('id' => $id)))
        );
    }

}
