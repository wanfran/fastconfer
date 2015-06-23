<?php

namespace AppBundle\Doctrine\ORM;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

/**
 * Class ConferenceRepository
 * @package AppBundle\Doctrine\ORM
 */
class ConferenceRepository extends EntityRepository
{
    /**
     * @param $word
     * @return array
     * Función para encontrar una conferencia en la BD por el nombre
     */
    public function findConference($word)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('
        SELECT c
        FROM AppBundle:Conference c
        WHERE c.name LIKE :word');

        $query->setParameter('word', '%'.$word.'%');

        return $query->getResult();
    }

    /**
     * @param User $user
     * @return array
     * Función para encontrar un usuario en la BD por el nombre
     */
    public function findUserConferences(User $user)
    {
        $qb = $this->createQueryBuilder('c');
        $query = $qb->leftJoin('c.inscriptions', 'i')
            ->leftJoin('c.chairmans', 'ch')
            ->where('ch.id = :id')
            ->orWhere('i.user = :id')
            ->setParameter('id', $user->getId())
            ->getQuery()
            ;
        return $query->getResult();
    }
}
