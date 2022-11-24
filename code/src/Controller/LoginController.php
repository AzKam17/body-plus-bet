<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function login(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        JWTTokenManagerInterface $JWTManager,
        UserRepository $userRepository
    ): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);
            if (empty($data['username']) || empty($data['password'])) {
                throw new \Exception('Username and password are required');
            }

            /** @var User $user */
            $user = $userRepository->findOneBy(['username' => $data['username']]);
            if (!$user) {
                throw new \Exception('User not found');
            }

            if($user->isIsBanned()) {
                throw new \Exception('User is banned');
            }

            if (!$passwordHasher->isPasswordValid($user, $data['password'])) {
                throw new \Exception('Invalid password');
            }

            $token = $JWTManager->create($user);

            return $this->json([
                'token' => $token,
            ]);

        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], 400);
        }
    }
}
