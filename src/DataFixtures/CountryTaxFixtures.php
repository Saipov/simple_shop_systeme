<?php

namespace App\DataFixtures;

use App\Entity\CountryTax;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CountryTaxFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $countriesTax = [
            [
                'ref' => 'DE',
                'tax' => 19,
                'vatFormat' => 'DEXXXXXXXXX',
            ],
            [
                'ref' => 'IT',
                'tax' => 22,
                'vatFormat' => 'ITXXXXXXXXXXX',
            ],
            [
                'ref' => 'GR',
                'tax' => 24,
                'vatFormat' => 'GRXXXXXXXXX',
            ],
            [
                'ref' => 'FR',
                'tax' => 20,
                'vatFormat' => 'FRYYXXXXXXXXX',
            ],
        ];

        foreach ($countriesTax as $value) {
            $countryTax = new CountryTax();
            $countryTax->setCountry($this->getReference($value['ref']));
            $countryTax->setTaxRate($value['tax']);
            $countryTax->setVatFormat($value['vatFormat']);
            $manager->persist($countryTax);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CountryFixtures::class,
        ];
    }
}
