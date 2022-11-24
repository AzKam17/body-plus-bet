<?php

namespace App\DataFixtures;

use App\Entity\ContactsCashin;
use App\Entity\MobileMoneyOperator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class MobileMoneyOperatorFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            [
                'name' => 'Orange Money',
                'logo' => 'om.png',
            ],
            [
                'name' => 'Moov Money',
                'logo' => 'moov.png',
            ],
            [
                'name' => 'MTN Mobile Money',
                'logo' => 'momo.png',
            ],
            [
                'name' => 'Wave',
                'logo' => 'wave.png',
            ]
        ];


        foreach ($data as $item) {
            $phone = (new ContactsCashin())
                ->setPhone('+225 07 57 00 05 81');
            $manager->persist($phone);
            $operator = new MobileMoneyOperator();
            $operator->setName($item['name']);
            $operator->setLogo($item['logo']);
            $operator->setIsActive(true);
            $operator->addContactsCashin($phone);
            $manager->persist($operator);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['prod'];
    }
}
