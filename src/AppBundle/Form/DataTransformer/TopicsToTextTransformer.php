<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 13/04/15
 * Time: 17:12.
 */

namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Topic;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;

class TopicsToTextTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * Constructor.
     *
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * Transforms an ArrayCollection to a string.
     *
     * @param $tags ArrayCollection|null
     *
     * @return string
     */
    public function transform($topics)
    {
        if (null === $topics) {
            return "";
        }

        return implode(", ", $topics->toArray());
    }

    /**
     * Transforms a string to an ArrayCollection.
     *
     * @param string $value
     *
     * @return ArrayCollection
     */
    public function reverseTransform($value)
    {
        $topics = new ArrayCollection();

        if (null === $value) {
            return $topics;
        }

        $tokens = preg_split('/(\s*,\s*)+/', $value, -1, PREG_SPLIT_NO_EMPTY);
        foreach ($tokens as $token) {
            if (null === ($topic = $this->om->getRepository('AppBundle:Topic')->findOneByName($token))) {
                $topic = new Topic();
                $topic->setName($token);
                $this->om->persist($topic);
            }
            $topics->add($topic);
        }
        $this->om->flush();

        return $topics;
    }
}
