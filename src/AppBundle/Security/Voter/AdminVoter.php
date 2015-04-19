<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/04/15
 * Time: 12:19
 */

namespace AppBundle\Security\Voter;


use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter;
use Symfony\Component\Security\Core\User\UserInterface;

class AdminVoter extends AbstractVoter
{

    /**
     * Return an array of supported classes. This will be called by supportsClass
     *
     * @return array an array of supported classes, i.e. array('Acme\DemoBundle\Model\Product')
     */
    protected function getSupportedClasses()
    {
        return array('Sonata\AdminBundle\Admin\Admin');
    }

    /**
     * Return an array of supported attributes. This will be called by supportsAttribute
     *
     * @return array an array of supported attributes, i.e. array('CREATE', 'READ')
     */
    protected function getSupportedAttributes()
    {
        return array('LIST', 'VIEW', 'EDIT', 'CREATE', 'DELETE', 'EXPORT');
    }

    /**
     * Perform a single access check operation on a given attribute, object and (optionally) user
     * It is safe to assume that $attribute and $object's class pass supportsAttribute/supportsClass
     * $user can be one of the following:
     *   a UserInterface object (fully authenticated user)
     *   a string               (anonymously authenticated user)
     *
     * @param string $attribute
     * @param object $object
     * @param UserInterface|string $user
     *
     * @return bool
     */
    protected function isGranted( $attribute, $object, $user = null )
    {
        return true;
    }
}