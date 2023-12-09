<?php

namespace App\DataFixtures;

use App\Entity\Balance;
use App\Entity\Currency;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BalanceFixture extends Fixture
{
    public const BALANCE_REFERENCE = 'balance';
    public function load(ObjectManager $manager): void
    {
        $balance = new Balance();
        $balance->setAmount(0);
        $balance->setCurrency(Currency::EUR);
        $manager->persist($balance);
        $this->addReference(self::BALANCE_REFERENCE, $balance);

        $manager->flush();
    }
}
