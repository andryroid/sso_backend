<?php


namespace App\EventListener;


use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

class AuthenticationSuccessListener
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * AuthenticationSuccessListener constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $event->setData([
            'id' => $event->getUser()->getId(),
            'token' => $event->getData()['token']
        ]);
    }
}