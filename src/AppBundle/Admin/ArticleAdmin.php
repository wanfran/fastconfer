<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 6/04/15
 * Time: 17:13
 */

namespace AppBundle\Admin;

use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;


class ArticleAdmin extends Admin
{

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('reviewers')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Article')
            ->add('title')
            ->add('author')
            ->add('keyword')
            ->add('abstract')
            ->add('stateEnd')
            ->add('createAt')
            ->add('topics')
            ->end()
            ->with('Reviewers')
            ->add('reviewers')

            ->end()
        ;
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->add('title')

            ->add('_action', 'actions', array(
                'actions' => array(
                    'list' => array(
                        'template' => 'Organization/CRUD/list__action_list_articleReviews.html.twig'
                    ),
                    'show' => array(),
                )))
        ;
    }

    public function getParentAssociationMapping()
    {
        return 'inscription';
    }

    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if (!$childAdmin && !in_array($action, array('show'))) {
            return;
        }

        $admin = $this->isChild() ? $this->getParent() : $this;

        $id = $admin->getRequest()->get('id');

        $menu->addChild(
            'Add reviewer',
            array('uri' => $admin->generateUrl('fastconfer.admin.article.edit', array('id' => $id)))

        );
    }
}