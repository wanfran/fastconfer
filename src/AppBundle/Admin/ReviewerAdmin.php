<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 7/04/15
 * Time: 19:20.
 */

namespace AppBundle\Admin;

use AppBundle\Main\AssignReviewerEvents;
use AppBundle\Main\Event\AssignReviewerEvent;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class ReviewerAdmin
 * @package AppBundle\Admin
 * Clase para definir la vista de revisores en Sonata
 */
class ReviewerAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('user', null, array(
                'property' => 'getCompleteName',
            ))
        ;
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->add('user', null, array(
                'associated_tostring' => 'getCompleteName',
            ))
        ;
    }

    /**
     * @return string
     */
    public function getParentAssociationMapping()
    {
        return 'article';
    }

    public function postPersist($object)
    {
        $event = new AssignReviewerEvent($object);
        $event = $this->getConfigurationPool()->getContainer()->get('event_dispatcher')->dispatch( AssignReviewerEvents::SUBMITTED, $event );
    }
}
