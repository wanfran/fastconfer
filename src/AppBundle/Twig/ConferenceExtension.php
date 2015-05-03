<?php
/**
 * Created by PhpStorm.
 * User: fran
 * Date: 29/04/15
 * Time: 17:14
 */

namespace AppBundle\Twig;

use AppBundle\Entity\Conference;
use Symfony\Component\HttpFoundation\RequestStack;

class ConferenceExtension extends \Twig_Extension
{
    /**
     * @var RequestStack
     */
    private $requestStack;


    /**
     * @param RequestStack $requestStack
     */
    function __construct($requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
          new \Twig_SimpleFunction('conference_url',[$this, 'conferenceURL']),
        ];
    }

    /**
     * Returns the base url of a conference
     *
     *
     * @param Conference $conference
     * @return string
     */
    public function conferenceURL(Conference $conference)
    {
        $request = $this->requestStack->getCurrentRequest();

        return str_replace('www', $conference->getCode(), $request->getUri());
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
       return 'fastconfer_conference';
    }
}
