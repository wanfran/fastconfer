<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 23/03/15
 * Time: 22:36.
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\ReviewComments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class ReviewerType
 * @package AppBundle\Form\Type
 * Clase para crear el Formulario para revisar un artículo
 */
class ReviewerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment', 'textarea', array('label'=> 'Comment to User',
                'attr' => array('cols' => '10', 'rows' => '10'), ))
            ->add('state', 'choice', array(
                'choices' => array('accepted' => 'Accept', 'accepted with suggestions' => 'Accept with suggerences', 'rejected' => 'Reject', ),
                'preferred_choices' => array('accepted'),
            ))

            ->add('privateComment', 'textarea', array('label'=> 'Comment to Chairman',
                'attr' => array('cols' => '10', 'rows' => '10'), ))
            ->add('save', 'submit', array('label' => 'Submit'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ReviewComments',
        ));
    }
    public function getName()
    {
        return 'ReviewComments';
    }
}
