<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 6/04/15
 * Time: 19:26.
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class ArticleReviewAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('state')
            ->add('path')
            ->add('createAt', 'sonata_type_datetime_picker', array(
            'format' => 'dd MMMM YY',
        ))
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('state')
            ->add('path')
            ->add('createAt')
        ;
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->add('article')
            ->add('state')
            ->add('createAt')
            ->add('_action', 'actions', array('label'=>'Actions',
                'actions' => array(
                    'show' => array(),
                ),
            ))
        ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add( 'accepted', $this->getRouterIdParameter() . '/accepted');
        $collection->add( 'accepted with suggestions', $this->getRouterIdParameter() . '/accepted_with_suggestions');
        $collection->add( 'rejected', $this->getRouterIdParameter() . '/rejected');
    }


    public function getParentAssociationMapping()
    {
        return 'article';
    }
}
