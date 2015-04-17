<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 6/04/15
 * Time: 17:13.
 */

namespace AppBundle\Admin;

use AppBundle\Main\AssignReviewerEvents;
use AppBundle\Main\Event\AssignReviewerEvent;
use AppBundle\Main\StateEndEvents;
use AppBundle\Main\Event\StateEndEvent;
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
            ->add('stateEnd', 'choice', array(
        'choices' => array('accepted' => 'Accepted', 'accepted with suggestions' => 'Accepted with suggestions',
            'rejected' => 'Rejected', ),
        'preferred_choices' => array('accepted'), ))
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
                        'template' => 'Organization/CRUD/list__action_list_articleReviews.html.twig',
                    ),
                    'show' => array(),
                ), ))
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

//    public function postUpdate($object)
//    {
//        $event = new AssignReviewerEvent($object);
//        $event = $this->getConfigurationPool()->getContainer()->get('event_dispatcher')->dispatch( AssignReviewerEvents::SUBMITTED, $event );
//    }

    public function postUpdate($object)
    {
        $event = new StateEndEvent($object);
        $event = $this->getConfigurationPool()->getContainer()->get('event_dispatcher')->dispatch(StateEndEvents::SUBMITTED, $event);
    }
}
