<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 30/03/15
 * Time: 19:52
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseGroup;
/**
 * @ORM\Entity()
 * @ORM\Table(name="fos_group")
 */
class Group extends BaseGroup
{
        /**
         * @ORM\Id
         * @ORM\Column(type="integer")
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        protected $id;
}
