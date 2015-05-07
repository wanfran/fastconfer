<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 6/05/15
 * Time: 21:38
 */

namespace AppBundle\Main;


class TwigMailGenerator
{
    protected $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function getMessage($identifier,$parameters = array())
    {
        $template = $this->twig->loadTemplate('mail/'.$identifier.'.twig');

        $subject = $template->render('subject',   $parameters);
        $bodyHtml = $template->render('body_html', $parameters);
        $bodyText = $template->render('body_text', $parameters);

        return \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setBody($bodyText, 'text/plain')
            ->addPart($bodyHtml, 'text/html')
            ;
    }

//    /**
//     * @return \Twig_Environment
//     */
//    public function getTwig()
//    {
//        return $this->twig;
//    }
//
//    /**
//     * @param \Twig_Environment $twig
//     */
//    public function setTwig($twig)
//    {
//        $this->twig = $twig;
//    }

}