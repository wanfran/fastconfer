<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 30/03/15
 * Time: 19:46
 */

namespace AppBundle\Admin;

use Sonata\UserBundle\Admin\Entity\GroupAdmin as BaseGroupAdmin;


class GroupAdmin extends BaseGroupAdmin
{
   	/**
     * {@inheritdoc}
     */
    protected $baseRouteName = "fastconfer_group";

	/**
	 * {@inheritdoc}
	 */
	protected $baseRoutePattern = 'fastconfer/group';
}
