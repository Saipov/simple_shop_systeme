<?php

namespace App\Service\Discount;

use App\Entity\ProductDiscount;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class DiscountProductService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    )
    {
    }

    /**
     * @param int $price
     * @param string $couponCode
     * @return int
     */
    public function applyDiscount(int $price, string $couponCode): int
    {
        $productDiscount = $this->getProductDiscount($couponCode);
        $discount = DiscountHandler::getDiscountType($productDiscount->getCouponType()->value);

        return $discount->applyDiscount($price, $productDiscount->getValue());
    }

    /**
     * @param string $couponCode
     * @return mixed
     */
    private function getProductDiscount(string $couponCode): mixed
    {
        $productDiscount = $this->entityManager->getRepository(ProductDiscount::class)->findProductDiscount($couponCode);

        if ($productDiscount === null) {
            // TODO: Кастомные ошибки решил не делать
            throw new BadRequestHttpException("Invalid discount coupon");
        }

        return $productDiscount;
    }
}