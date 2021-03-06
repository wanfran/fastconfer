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

/**
 * Class ArticleReviewAdmin
 * @package AppBundle\Admin
 * Clase para definir la vista de las versiones de un artículo en Sonata
 */
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

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->add('article')
            ->add('state')
            ->add('createAt')
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
