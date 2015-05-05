<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 26/04/15
 * Time: 19:02
 */

namespace AppBundle\Security\Voter;


use AppBundle\Entity\ArticleReview;
use AppBundle\Entity\Reviewer;
use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Check download article permissions
 *
 * Class ArticleReviewDownloadVoter
 * @package AppBundle\Security\Voter
 */
class ArticleReviewDownloadVoter extends AbstractVoter
{

    /**
     * Return an array of supported classes. This will be called by supportsClass
     *
     * @return array an array of supported classes, i.e. array('Acme\DemoBundle\Model\Product')
     */
    protected function getSupportedClasses()
    {
        return [
            'AppBundle\Entity\ArticleReview',
        ];
    }

    /**
     * Return an array of supported attributes. This will be called by supportsAttribute
     *
     * @return array an array of supported attributes, i.e. array('CREATE', 'READ')
     */
    protected function getSupportedAttributes()
    {
        return [
            'DOWNLOAD',
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
     * @param ArticleReview $object
     * @param UserInterface|string $user
     *
     * @return bool
     */
    protected function isGranted( $attribute, $object, $user = null )
    {
        if ($user == $object->getArticle()->getInscription()->getUser()) {
            return true;
        }

        /** @var Reviewer $reviewer */
        foreach($object->getArticle()->getReviewers() as $reviewer) {
            if ($reviewer->getUser() == $user) {
                return true;
            }
        }

        return false;
    }
}