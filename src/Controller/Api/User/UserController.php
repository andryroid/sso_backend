<?php

namespace App\Controller\Api\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/api/user/user", name="api_user_user")
     */
    public function index(): Response
    {
        return $this->render('api/user/user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
