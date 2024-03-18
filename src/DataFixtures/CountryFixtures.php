<?php

namespace App\DataFixtures;

use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CountryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $countries = [
            [
                'code2' => 'DE',
                'name' => 'Germany',
            ],
            [
                'code2' => 'IT',
                'name' => 'Italy',
            ],
            [
                'code2' => 'GR',
                'name' => 'Greece',
            ],
            [
                'code2' => 'FR',
                'name' => 'France',
            ],
        ];

        foreach ($countries as $value) {
            $country = new Country();
            $country->setCode2($value['code2']);
            $country->setName($value['name']);

            $manager->persist($country);
            $manager->flush();

            $this->addReference($value['code2'], $country);
        }
    }
}
