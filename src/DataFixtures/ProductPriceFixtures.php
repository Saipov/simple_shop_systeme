<?php

namespace App\DataFixtures;

use App\Entity\ProductPrice;
use App\Entity\ValueObject\Money;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductPriceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $productsPrice = [
            [
                'ref' => 'Apple iPhone',
                'isActive' => true,
                'price' => 100,
            ],
            [
                'ref' => 'Headphones',
                'isActive' => true,
                'price' => 20,
            ],
            [
                'ref' => 'Сase',
                'isActive' => true,
                'price' => 10,
            ],
        ];

        foreach ($productsPrice as $value) {
            $productPrice = new ProductPrice();
            $productPrice->setProduct($this->getReference($value['ref']));
            $productPrice->setCurrency($this->getReference('EUR'));
            $productPrice->setPrice(new Money($value['price'], 'EUR'));
            $manager->persist($productPrice);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProductFixtures::class,
        ];
    }
}
