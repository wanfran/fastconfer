<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/04/15
 * Time: 11:47
 */

namespace AppBundle\Security\Voter;


use AppBundle\Entity\Conference;
use AppBundle\Security\Manager\ConferenceManager;
use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class ConferenceVoter
 * @package AppBundle\Security\Voter
 * Clase para crear el Voter que da permisos al Super Usuario
 */
class ConferenceVoter extends AbstractVoter
{
    /**
     * @var ConferenceManager
     */
    private $cm;

    function __construct(ConferenceManager $cm)
    {
        $this->cm = $cm;
    }

    /**
     * Return an array of supported classes. This will be called by supportsClass
     *
     * @return array an array of supported classes, i.e. array('Acme\DemoBundle\Model\Product')
     */
    protected function getSupportedClasses()
    {
        return array(
            'AppBundle\Entity\Conference',
            'AppBundle\Entity\Inscription',
            'AppBundle\Entity\Article',
            'AppBundle\Entity\ArticleReview',
        );
    }

    /**
     * Return an array of supported attributes. This will be called by supportsAttribute
     *
     * @return array an array of supported attributes, i.e. array('CREATE', 'READ')
     */
    protected function getSupportedAttributes()
    {
        return ['ROLE_APP_ADMIN_OBJECT_VIEW',
            'ROLE_APP_ADMIN_OBJECT_EDIT',
            'ROLE_APP_ADMIN_OBJECT_CREATE',
            'ROLE_APP_ADMIN_OBJECT_DELETE',
            'ROLE_APP_ADMIN_OBJECT_LIST',
            'ROLE_APP_ADMIN_OBJECT_EXPORT',
            ];
    }

    /**
     * Perform a single access check operation on a given attribute, object and (optionally) user
     * It is safe to assume that $attribute and $object's class pass supportsAttribute/supportsClass
     * $user can be one of the following:
     *   a UserInterface object (fully authenticated user)
     *   a string               (anonymously authenticated user)
     *
     * @param string $attribute
     * @param Conference $object
     * @param UserInterface|string $user
     *
     * @return bool
     */
    protected function isGranted( $attribute, $object, $user = null )
    {
        if (!$object instanceof Conference) {
            $object = $object->getConference();
        }

        if ( $object->getId() == $this->cm->getConference()->getId() ) {
            return true;
        }

        return false;
    }
}