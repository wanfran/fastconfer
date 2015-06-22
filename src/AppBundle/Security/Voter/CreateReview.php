<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 21/06/15
 * Time: 18:52
 */

namespace AppBundle\Security\Voter;


use AppBundle\Entity\Article;
use AppBundle\Entity\ReviewComments;
use AppBundle\Entity\Reviewer;
use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter;
use Symfony\Component\Security\Core\User\UserInterface;

class CreateReview extends AbstractVoter
{

    /**
     * Return an array of supported classes. This will be called by supportsClass
     *
     * @return array an array of supported classes, i.e. array('Acme\DemoBundle\Model\Product')
     */
    protected function getSupportedClasses()
    {
        return ['AppBundle\Entity\Article'];
    }

    /**
     * Return an array of supported attributes. This will be called by supportsAttribute
     *
     * @return array an array of supported attributes, i.e. array('CREATE', 'READ')
     */
    protected function getSupportedAttributes()
    {
        return ['CREATE'];
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
        if ($object->getStateEnd() != Article::STATUS_SENT) {
            return false;
        }

        /** @var Reviewer $reviewer */
        foreach($object->getReviewers() as $reviewer) {
            if ($reviewer->getUser() == $user ) {

                $reviews = $object->getArticleReviews()->last()->getReviewComments();
                /** @var ReviewComments $review */
                foreach($reviews as $review) {
                    if ($review->getReviewer()->getUser() == $user) {
                        return false;
                    }
                }

                return true;
            }
        }

        return false;
    }
}