<?php

namespace App\Service\Discount;

class DiscountHandlerPercentage implements DiscountHandlerInterface
{
    public function applyDiscount(int $price, float $discountValue): int
    {
        return $price * (1 - ($discountValue / 100));
    }
}
