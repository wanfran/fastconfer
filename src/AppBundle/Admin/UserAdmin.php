<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 30/03/15
 * Time: 19:48
 */

namespace AppBundle\Admin;


use Sonata\UserBundle\Admin\Entity\UserAdmin as BaseUserAdmin;

class UserAdmin extends BaseUserAdmin
{
    /**
     * {@inheritdoc}
     */
    protected $baseRouteName = "lanzadera_user";

	/**
	 * {@inheritdoc}
	 */
	protected $baseRoutePattern = 'lanzadera/user';

    /**
     * {@inheritdoc}
     */
    protected $datagridValues = array(
                '_page' => 1,            // display the first page (default = 1)
                '_sort_order' => 'ASC', // reverse order (default = 'ASC')
                '_sort_by' => 'username'  // name of the ordered field
                );
}