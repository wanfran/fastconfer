<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 13/04/15
 * Time: 18:20
 */

namespace AppBundle\Admin;

use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;


class ReviewCommentsAdmin extends Admin
{
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('comment')
        ;
    }
}