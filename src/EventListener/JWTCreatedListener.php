<?php
namespace App\EventListener;

use App\Repository\UserRepository;
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
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @param RequestStack $requestStack
     * @param Security $security
     * @param UserRepository $userRepository
     */
    public function __construct(RequestStack $requestStack,Security $security,UserRepository $userRepository)
    {
        $this->requestStack = $requestStack;
        $this->security = $security;
        $this->userRepository = $userRepository;
    }

    /**
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        //get the direct url if exist, and add custom information to the token if needed!
        $redirectUrl = $this->requestStack->getCurrentRequest()->get('redirectUrl') ? $this->requestStack->getCurrentRequest()->get('redirectUrl') : "defaultUrl";

        //get current user
        $user = $this->userRepository->findOneBy(['username' => $this->security->getUser()->getUserIdentifier()]);

        //custom jwt's content
        $payload       = $event->getData();
        //dummy example
        $payload['url_redirect'] = $redirectUrl;
        $payload['user_id'] = $user->getId();

        $event->setData($payload);

        /*$header        = $event->getHeader();
        $header['cty'] = 'JWT';

        $event->setHeader($header);*/
    }
}