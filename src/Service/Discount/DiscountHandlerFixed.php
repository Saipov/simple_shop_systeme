<?php

namespace App\Service\Discount;

class DiscountHandlerFixed implements DiscountHandlerInterface
{
    public function applyDiscount(int $price, float $discountValue): int
    {
        // $discountValue переводим в центы
        return $price - ($discountValue * 100);
    }
}
