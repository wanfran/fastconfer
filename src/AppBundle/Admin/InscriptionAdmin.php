<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 5/04/15
 * Time: 20:03.
 */

namespace AppBundle\Admin;

use Doctrine\ORM\QueryBuilder;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Class InscriptionAdmin
 * @package AppBundle\Admin
 * Clase para definir la vista de las inscripciones en Sonata
 */
class InscriptionAdmin extends Admin
{
    public function createQuery( $context = 'list' )
    {
        $conference = $this->getCurrentConference();
        /** @var QueryBuilder $query */
        $query = parent::createQuery( $context );
        $alias = current($query->getRootAliases());
        $query->andWhere($query->expr()->eq($alias.'.conference', ':conference'))
            ->setParameter('conference', $conference)
        ;

        return $query;
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->add('user', null, array(
                'property' => 'getCompleteName',
            ))
            ->add('createdAt')
        ;
    }
}
