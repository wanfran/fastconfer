<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 13/04/15
 * Time: 18:20.
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Class ReviewCommentsAdmin
 * @package AppBundle\Admin
 * Clase para definir la vista de los comentarios de cada revisor en Sonata
 */
class ReviewCommentsAdmin extends Admin
{
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('comment')
        ;
    }
}
