<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 5/04/15
 * Time: 20:03
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;

class InscriptionAdmin extends Admin
{

    /**
     * {@inheritdoc}
     */
    protected $baseRouteName = "fastconfer_inscription";

    /**
     * {@inheritdoc}
     */
    protected $baseRoutePattern = 'inscription';

    public function getParentAssociationMapping()
    {
        return 'conference';
    }


    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->add('conference')
        ;
    }


}