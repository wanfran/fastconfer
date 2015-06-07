<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 2/06/15
 * Time: 19:30
 */

namespace AppBundle\Form\Type;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;


class ProfileType extends BaseType
{
    public function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildUserForm($builder, $options);

        $builder->add('organization');
    }

    public function getName()
    {
        return 'fastconfer_user_profile';
    }
}