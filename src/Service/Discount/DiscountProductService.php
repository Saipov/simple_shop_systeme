<?php

namespace App\Service\Discount;

use App\Entity\ProductDiscount;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class DiscountProductService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public function applyDiscount(int $price, string $couponCode): int
    {
        $productDiscount = $this->getProductDiscount($couponCode);
        $discount = DiscountHandler::getDiscountType($productDiscount->getCouponType()->value);

        return $discount->applyDiscount($price, $productDiscount->getValue());
    }

    private function getProductDiscount(string $couponCode): mixed
    {
        $productDiscount = $this->entityManager->getRepository(ProductDiscount::class)->findProductDiscount($couponCode);

        if (null === $productDiscount) {
            // TODO: Кастомные ошибки решил не делать
            throw new BadRequestHttpException('Invalid discount coupon');
        }

        return $productDiscount;
    }
}
