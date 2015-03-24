<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 23/03/15
 * Time: 22:36
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\ReviewComments;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReviewerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment','textarea')
            ->add('state', 'choice', array(
                'choices' => array('accepted' => 'Accepted', 'accepted with suggestions' => 'Accepted with suggestions',
                    'rejected' => 'Rejected'),
                'preferred_choices' => array('accepted'),
            ));
//            ->add('save', 'submit', array('label' => 'Submit'));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ReviewComments'
        ));
    }
    public function getName()
    {
        return 'ReviewComments';
    }


}