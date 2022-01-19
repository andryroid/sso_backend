<?php
namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;

class JWTCreatedListener
{
    /**
     * @var RequestStack
     */
    private $requestStack;
    /**
     * @var Security
     */
    private $security;

    /**
     * @param RequestStack $requestStack
     * @param Security $security
     */
    public function __construct(RequestStack $requestStack,Security $security)
    {
        $this->requestStack = $requestStack;
        $this->security = $security;
    }

    /**
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        $request = $this->requestStack->getCurrentRequest();

        $payload       = $event->getData();
        $payload['id'] = $this->security->getUser()->getUserIdentifier();

        $event->setData($payload);

        /*$header        = $event->getHeader();
        $header['cty'] = 'JWT';

        $event->setHeader($header);*/
    }
}