<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 22/02/15
 * Time: 18:22
 */


namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TopicRepository extends EntityRepository
{
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