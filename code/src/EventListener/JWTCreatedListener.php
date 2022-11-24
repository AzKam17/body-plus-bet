<?php

namespace App\EventListener;

use App\Entity\User;
use Carbon\CarbonImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\HttpFoundation\RequestStack;

class JWTCreatedListener
{
    public function __construct(
        private RequestStack $requestStack,
        private EntityManagerInterface $entityManager,
    )
    {
    }

    /**
     * @throws Exception
     */
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        //Get user
        /** @var User $user */
        $user = $event->getUser();
        $request = $this->requestStack->getCurrentRequest();

        $payload = $event->getData();
        //generate random string 64 characters long
        $payload['hash'] = bin2hex(random_bytes(4));
        $user->setTokenHash($payload['hash']);
        $user->setLastConnection(CarbonImmutable::now());

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $event->setData($payload);
    }
}