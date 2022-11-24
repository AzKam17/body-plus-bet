<?php

namespace App\EventListener;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTDecodedEvent;
use Symfony\Component\HttpFoundation\RequestStack;

class JWTDecodedListener
{
    public function __construct(
        private RequestStack $requestStack,
        private EntityManagerInterface $entityManager,
    )
    {
    }

    /**
     * @param JWTDecodedEvent $event
     *
     * @return void
     */
    public function onJWTDecoded(JWTDecodedEvent $event)
    {
        //Get user
        /** @var User $user */
        $payload = $event->getPayload();
        $username = $payload['username'];
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $username]);
        if (!$user) {
            $event->markAsInvalid();
        }

        $request = $this->requestStack->getCurrentRequest();
        $hash = ($event->getPayload())['hash'];
        if ($user->getTokenHash() !== $hash) {
            $event->markAsInvalid();
        }
    }
}