<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class JWTFixtures extends Fixture implements FixtureGroupInterface
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
    )
    {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('user');
        $user->setName('User');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->passwordHasher->hashPassword($user, 'user'));
        $manager->persist($user);
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['dev'];
    }
}
