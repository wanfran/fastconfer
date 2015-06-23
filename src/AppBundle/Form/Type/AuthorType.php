<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 4/05/15
 * Time: 18:59
 */

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class AuthorType
 * @package AppBundle\Form\Type
 * Clase para crear el Formulario para enviar un nuevo autor
 */
class AuthorType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fullname')
            ->add('organization')
            ->add('email')
            ->add('isNotified')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Author',
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'author';
    }
}