<?php

namespace App\DataFixtures;

use App\Entity\ProductDiscount;
use App\Enum\ProductDiscountTypeEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductDiscountFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $productsDiscount = [
            [
                'ref' => 'Apple iPhone',
                'couponCode' => 'P10',
                'couponType' => 'PERCENT',
                'value' => 10,
            ],
            [
                'ref' => 'Headphones',
                'couponCode' => 'P5',
                'couponType' => 'PERCENT',
                'value' => 5,
            ],
            [
                'ref' => 'Сase',
                'couponCode' => 'P100',
                'couponType' => 'PERCENT',
                'value' => 100,
            ],
            [
                'ref' => 'Apple iPhone',
                'couponCode' => 'F10',
                'couponType' => 'FIXED',
                'value' => 10,
            ],
            [
                'ref' => 'Headphones',
                'couponCode' => 'F5',
                'couponType' => 'FIXED',
                'value' => 5,
            ],
            [
                'ref' => 'Сase',
                'couponCode' => 'F0.25',
                'couponType' => 'FIXED',
                'value' => 0.25,
            ],
        ];

        foreach ($productsDiscount as $value) {
            $productDiscount = new ProductDiscount();
            $productDiscount->setCouponCode($value['couponCode']);
            $productDiscount->setProduct($this->getReference($value['ref']));

            match ($value['couponType']) {
                'PERCENT' => $productDiscount->setCouponType(ProductDiscountTypeEnum::PERCENT),
                'FIXED' => $productDiscount->setCouponType(ProductDiscountTypeEnum::FIXED)
            };

            $productDiscount->setValue($value['value']);
            $productDiscount->setDateStart(new \DateTimeImmutable('now'));
            $productDiscount->setIsActive(true);
            $manager->persist($productDiscount);
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
