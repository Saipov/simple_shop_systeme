<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $products = [
            [
                'name' => 'Apple iPhone',
                'isActive' => true,
            ],
            [
                'name' => 'Headphones',
                'isActive' => true,
            ],
            [
                'name' => 'Сase',
                'isActive' => true,
            ],
        ];

        foreach ($products as $value) {
            $product = new Product();
            $product->setName($value['name']);
            $product->setIsActive($value['isActive']);
            $manager->persist($product);
            $manager->flush();

            $this->addReference($value['name'], $product);
        }
    }
}
