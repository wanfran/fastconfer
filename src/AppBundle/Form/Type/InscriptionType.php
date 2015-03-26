<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 19/02/15
 * Time: 16:33
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\Article_Review;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InscriptionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $conference = $builder->getData()->getInscription()->getConference();

        $builder
            ->add('title')
            ->add('author')
            ->add('keyword')
            ->add('abstract', 'textarea')
            ->add('topics', 'entity', array(
                'class' => 'AppBundle:Topic',
                'property' => 'name',
                'multiple' => true,
                'expanded'=>true,
                'query_builder' => function(EntityRepository $er) use ($conference) {
                    return $er->getAllTopicsFromConference($conference);
                },
            ))

            ->add('path','file',array('mapped' => false)); //de esta forma pongo un atributo que no existe en esa clase

//            ->add('save', 'submit', array('label' => 'Submit'));

}
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Article'
        ));
    }
    public function getName()
    {
        return 'article';
    }

}