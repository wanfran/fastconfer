<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 21/06/15
 * Time: 18:52
 */

namespace AppBundle\Security\Voter;


use AppBundle\Entity\Reviewer;
use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class SeeCommentsReview
 * @package AppBundle\Security\Voter
 * Clase para crear el Voter que permite ver los comentarios
 */
class SeeCommentsReview extends AbstractVoter
{
    /**
     * Return an array of supported classes. This will be called by supportsClass
     *
     * @return array an array of supported classes, i.e. array('Acme\DemoBundle\Model\Product')
     */
    protected function getSupportedClasses()
    {
        return ['AppBundle\Entity\Reviewer'];
    }

    /**
     * Return an array of supported attributes. This will be called by supportsAttribute
     *
     * @return array an array of supported attributes, i.e. array('CREATE', 'READ')
     */
    protected function getSupportedAttributes()
    {
        return ['SHOW'];
    }

    /**
     * Perform a single access check operation on a given attribute, object and (optionally) user
     * It is safe to assume that $attribute and $object's class pass supportsAttribute/supportsClass
     * $user can be one of the following:
     *   a UserInterface object (fully authenticated user)
     *   a string               (anonymously authenticated user)
     *
     * @param string $attribute
     * @param Reviewer $object
     * @param UserInterface|string $user
     *
     * @return bool
     */
    protected function isGranted($attribute, $object, $user = null)
    {
        if ($object->getUser()== $user) {
            return true;
        }

        return false;
    }
}