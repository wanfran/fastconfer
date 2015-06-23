<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 22/02/15
 * Time: 18:22.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;


/**
 * Class TopicRepository
 * @package AppBundle\Entity
 */
class TopicRepository extends EntityRepository
{
    /**
     * @param Conference $conference
     * @return \Doctrine\ORM\QueryBuilder
     * Función para obtener todos los topic de una conferencia
     */
    public function getAllTopicsFromConference(Conference $conference)
    {
        $qb = $this->createQueryBuilder('t');
        $query = $qb
            ->leftJoin('t.conferences', 'c')
            ->where($qb->expr()->eq('c.id', ':id'))
        ;
        $query->setParameter('id', $conference->getId());

        return $query;
    }
}
