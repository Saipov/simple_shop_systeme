<?php

namespace App\DataFixtures;

use App\Entity\Currency;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CurrencyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $currency = new Currency();
        $currency->setCode('EUR');
        $currency->setName('Euro');
        $manager->persist($currency);
        $manager->flush();

        $this->addReference('EUR', $currency);
    }
}
