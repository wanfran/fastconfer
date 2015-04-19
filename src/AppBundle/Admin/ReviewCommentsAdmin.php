<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 13/04/15
 * Time: 18:20.
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Show\ShowMapper;

class ReviewCommentsAdmin extends Admin
{
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('comment')
        ;
    }
}
