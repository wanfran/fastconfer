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
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Request;

class ProfileFormHandler extends BaseHandler
{
    public function __construct(Form $form, Request $request, UserManagerInterface $userManager)
    {
        $form->add(
            'organization'
        );
        parent::__construct($form, $request, $userManager);
    }

}