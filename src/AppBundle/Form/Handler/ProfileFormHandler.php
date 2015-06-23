<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 2/06/15
 * Time: 19:33
 */

namespace AppBundle\Form\Handler;

use FOS\UserBundle\Model\UserManagerInterface;
use Sonata\UserBundle\Form\Handler\ProfileFormHandler as BaseHandler;
use Symfony\Component\Form\Form;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class ProfileFormHandler
 * @package AppBundle\Form\Handler
 * Clase para editar el Perfil del usuario
 */
class ProfileFormHandler extends BaseHandler
{
    public function __construct(Form $form, Request $request, UserManagerInterface $userManager)
    {
        // borrando campos no necesarios
        $form->remove('gender');
        $form->remove('website');
        $form->remove('biography');
        $form->remove('timezone');
        $form->remove('phone');
        $form->remove('locale');
        $form->remove('dateOfBirth');

        // cargando nuevos campos
        $form->add('username',null, array(
            'label' => 'Name of User'));
        $form->add('email');
        $form->add('organization');
//        $form->add('gravatar', 'file', array(
//        'mapped' => false,
//        'attr' => ['class' => 'filestyle','data-buttonBefore'=> 'true', 'data-buttonText' => 'Choose file' ]
//    ));
        parent::__construct($form, $request, $userManager);
    }

}