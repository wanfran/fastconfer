<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 3/02/15
 * Time: 23:09.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ConferenceRepository extends EntityRepository
{
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
}
