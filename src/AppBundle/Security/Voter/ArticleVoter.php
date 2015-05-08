<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 5/05/15
 * Time: 18:34
 */

namespace AppBundle\Security\Voter;


use AppBundle\Entity\Article;
use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter;
use Symfony\Component\Security\Core\User\UserInterface;

class ArticleVoter extends AbstractVoter
{

    /**
     * Return an array of supported classes. This will be called by supportsClass
     *
     * @return array an array of supported classes, i.e. array('Acme\DemoBundle\Model\Product')
     */
    protected function getSupportedClasses()
    {
        return [
            'AppBundle\Entity\Article',
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
            'UPLOAD_NEW_ARTICLE_REVIEW',
            'OWNER'
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
     * @param Article $object
     * @param UserInterface|string $user
     *
     * @return bool
     */
    protected function isGranted($attribute, $object, $user = null)
    {
        switch($attribute) {
            case 'UPLOAD_NEW_ARTICLE_REVIEW':
                // TODO: check deadtime
                if (Article::STATUS_ACCEPTED_SUGGESTIONS == $object->getStateEnd()) {
                    return true;
                }
                if (Article::STATUS_ACCEPTED_SUGGESTIONS == $object->getArticleReviews()->last()->getState()) {
                    return true;
                }
            break;
            case 'OWNER':
                if ($user instanceof UserInterface && $user->getUsername() === $object->getUser()->getUsername()) {
                    return true;
                }
            break;
        }

        return false;
    }
}