<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 2/06/15
 * Time: 19:30
 */

namespace AppBundle\Form\Type;
use Sonata\UserBundle\Form\Type\ProfileType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;


class ProfileType extends BaseType
{
    public function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', null, array(
                'label'    => 'form.label_firstname',
                'required' => false
            ))
            ->add('lastname', null, array(
                'label'    => 'form.label_lastname',
                'required' => false
            ))
            ->add('organization', null, array(
                'label'    => 'form.label_organization',
                'required' => false
            ))
        ;
    }

    public function getName()
    {
        return 'fastconfer_user_profile';
    }
}