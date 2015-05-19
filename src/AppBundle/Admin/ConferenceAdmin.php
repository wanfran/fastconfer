<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 5/04/15
 * Time: 18:36.
 */

namespace AppBundle\Admin;

use Doctrine\DBAL\Query\QueryBuilder;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;


class ConferenceAdmin extends Admin
{
    public function createQuery( $context = 'list' )
    {
        $conference = $this->getCurrentConference();

        /** @var QueryBuilder $query */
        $query = parent::createQuery( $context );
        $alias = current($query->getRootAliases());

        $query->andWhere( $query->expr()->eq( $alias.'.id', ':id'))
            ->setParameter('id', $conference->getId())
        ;

        return $query;

    }


    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'textarea')
            ->add('description', 'textarea')
            ->add('url')
            ->add('chairmans', null, array(
                'property' => 'getCompleteName'
            ))
            ->add('dateStart', 'sonata_type_date_picker')
            ->add('dateEnd', 'sonata_type_date_picker')
            ->add('deadTime', 'sonata_type_date_picker')
            ->add('dateNews', 'sonata_type_date_picker')
            ->add('topics', 'topics_text', array(
                'required' => false,
            ))
            ->add('image', 'file', array(
                'data_class' => null,
                'attr' => ['class' => 'filestyle']
            ))

        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {


        $showMapper
            ->add('name')
            ->add('description')
            ->add('url')
            ->add('dateStart')
            ->add('dateEnd')
            ->add('deadTime')
            ->add('dateNews')
            ->add('topics')
            ->add('image',null,array(
                'template' => 'image/image.html.twig',
            ))
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name',null,array('label' => 'Name'))
            ->add('_action', 'actions', array('label'=>'Actions',
                'actions' => array(
                    'edit' => array(),
                    'show' => array(),
                ),
            ))
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

    public function prePersist($object)
    {
        if ($object->getImage()) {
            $this->getService('stof_doctrine_extensions.uploadable.manager')->markEntityToUpload($object, $object->getImage());
        }
    }

    public function preUpdate($object)
    {
        if ($object->getImage()) {
            $this->getService('stof_doctrine_extensions.uploadable.manager')->markEntityToUpload($object, $object->getImage());
        }
    }
}
