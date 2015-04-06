<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 6/04/15
 * Time: 19:26
 */

namespace AppBundle\Admin;

use Knp\Menu\ItemInterface as MenuItemInterface;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ArticleReviewAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('state')
        ;
    }



    public function getParentAssociationMapping()
    {
        return 'articles';
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->add('title')
            ->add('state')

            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array())
            ))
        ;
    }



}