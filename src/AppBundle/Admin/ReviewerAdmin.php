<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 7/04/15
 * Time: 19:20
 */

namespace AppBundle\Admin;


use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ReviewerAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('users')
            ->add('articles')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('users')
            ->add('articles')

        ;
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->add('users')

            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'show' => array(),
                )))
        ;
    }

}