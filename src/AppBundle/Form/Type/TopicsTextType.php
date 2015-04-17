<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 13/04/15
 * Time: 17:17.
 */

namespace AppBundle\Form\Type;

use AppBundle\Form\DataTransformer\TopicsToTextTransformer;
use Symfony\Component\Form\AbstractType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormBuilderInterface;

class TopicsTextType extends AbstractType
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

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new TopicsToTextTransformer($this->om);
        $builder->addModelTransformer($transformer);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return "text";
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'topics_text';
    }
}
