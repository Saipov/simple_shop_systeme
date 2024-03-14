<?php

namespace App\DataFixtures;

use App\Entity\PaymentProvider;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PaymentProviderFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $paymentProvider1 = new PaymentProvider();
        $paymentProvider1->setName("paypal");
        $manager->persist($paymentProvider1);

        $paymentProvider1 = new PaymentProvider();
        $paymentProvider1->setName("stripe");
        $manager->persist($paymentProvider1);

        $manager->flush();
    }
}
