<?php

namespace App\Controller\Api\User;

use ApiPlatform\Core\Util\RequestAttributesExtractor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var UserPasswordHasherInterface
     */
    private $userPasswordHarsher;

    /**
     * UserController constructor.
     * @param EntityManagerInterface $entityManager
     * @param UserPasswordHasherInterface $userPasswordHarsher
     */
    public function __construct(EntityManagerInterface $entityManager,UserPasswordHasherInterface $userPasswordHarsher)
    {
        $this->entityManager = $entityManager;
        $this->userPasswordHarsher = $userPasswordHarsher;
    }

    public function __invoke($data,Request $request)
    {
        $attribute = RequestAttributesExtractor::extractAttributes($request);
        $action = $attribute['collection_operation_name'] ?? $attribute['item_operation_name'] ?? null;
        if (!is_null($action)) {
            if ($action === "create_user") {
                return $this->createUser($request);
            }
        }
    }


    /**
     * @param User $user
     * @param Request $request
     */
    public function createUser(User $user,Request $request){

    }
}
