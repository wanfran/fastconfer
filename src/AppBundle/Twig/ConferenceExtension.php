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
use Symfony\Component\Routing\RouterInterface;

class ConferenceExtension extends \Twig_Extension
{
    /**
     * @var RouterInterface
     */
    private $router;


    /**
     * @param RequestStack $requestStack
     */
    function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('conference_admin_url',[$this, 'conferenceBackendURL']),
        ];
    }

    public function conferenceBackendURL(Conference $conference)
    {
        $url = $this->router->generate('sonata_admin_dashboard', [], RouterInterface::ABSOLUTE_URL);

        return str_replace('www', $conference->getCode(), $url);
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
