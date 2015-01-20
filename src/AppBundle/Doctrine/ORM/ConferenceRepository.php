<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 11/01/15
 * Time: 18:52
 */

namespace AppBundle\Doctrine\ORM;


use Doctrine\ORM\EntityRepository;

class ConferenceRepository extends EntityRepository
{
    public function deleteAll()
    {

           $em = $this->getEntityManager();
           $query = $em->createQuery('delete from AppBundle:Conference c');
         return $query->execute();

     }



}