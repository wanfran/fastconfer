<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 22/06/15
 * Time: 19:16
 */

namespace AppBundle\Security\Voter;


use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class ArticleComment
 * @package AppBundle\Security\Voter
 * Clase para crear el Voter que permite ver los comentarios de un artículo
 */
class ArticleComment extends AbstractVoter{

    /**
     * Return an array of supported classes. This will be called by supportsClass
     *
     * @return array an array of supported classes, i.e. array('Acme\DemoBundle\Model\Product')
     */
    protected function getSupportedClasses()
    {
        return[

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
            'DISABLED_BUTTON'
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
        if($object->getStateEnd()!= Article::STATUS_SENT)
        {
            return true;
        }
    }
}