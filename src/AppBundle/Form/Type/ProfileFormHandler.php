<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 2/06/15
 * Time: 19:33
 */

namespace AppBundle\Form\Type;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Form\Handler\ProfileFormHandler as BaseHandler;

class ProfileFormHandler extends BaseHandler
{

    public function process(UserInterface $user)
    {
        return parent::process($user);

        $this->form->setData($user);
        if ('POST' == $this->request->getMethod()) {
            $this->form->bindRequest($this->request);

            if ($this->form->isValid()) {
                $nombreArchivoFoto = uniqid().$user->getId() . '-' . $user->getUsername() . '-foto-perfil.jpg';
                $user->upload($nombreArchivoFoto);
                $this->onSuccess($user);
                return true;
            }
            $this->userManager->reloadUser($user);
        }
        return false;
    }

    protected function onSuccess(UserInterface $user)
    {
        $this->userManager->updateUser($user);
    }
}