<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 6/04/15
 * Time: 17:13.
 */

namespace AppBundle\Admin;

use Doctrine\ORM\QueryBuilder;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Class ArticleAdmin
 * @package AppBundle\Admin
 * Clase para definir la vista de los artículos en Sonata
 */
class ArticleAdmin extends Admin
{

    public function createQuery( $context = 'list' )
    {
        $conference = $this->getCurrentConference();
        /** @var QueryBuilder $query */
        $query = parent::createQuery( $context );
        $alias = current($query->getRootAliases());
        $query->leftJoin($alias.'.inscription', 'i')
            ->andWhere($query->expr()->eq('i.conference', ':conference'))
            ->setParameter('conference', $conference)
        ;

        return $query;
    }

//     Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('stateEnd', 'choice', array(
        'choices' => array('accepted' => 'Accepted', 'accepted with suggestions' => 'Accepted with suggestions', 'rejected' => 'Rejected', ),
        'preferred_choices' => array('accepted'), ))
            ->add('comment', 'textarea', array(
                'mapped' => false,
            ))
        ;

        $formMapper->getFormBuilder()->addEventSubscriber($this->getConfigurationPool()->getContainer()->get('fastconfer.listener.stateendevent'));
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Article')
            ->add('title')
            ->add('authors')
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
            ->add('user')
            ->add('stateEnd', null, array(
                'template' => 'backend/Article/CRUD/list__show_state_end.html.twig'
            ))
            ->add('_action', 'actions', array(
                'label'=>'Actions',
                'actions' => array(
                    'review_list' => array(
                        'label' => 'List Reviewer',
                        'template' => 'backend/Article/CRUD/list__action_list_reviews.html.twig',
                    ),
                    'reviewer_list' => array(
                        'template' => 'backend/Article/CRUD/list__action_list_reviewer.html.twig',
                    ),
                    'editStateEnd_list' => array(
                        'template' => 'backend/Article/CRUD/list__action_edit_stateEnd.html.twig',
                    ),
                    'show' => array(),

                ),
            ))
        ;
    }
}
