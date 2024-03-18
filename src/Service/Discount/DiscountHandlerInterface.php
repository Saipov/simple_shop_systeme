<?php

namespace App\Service\Discount;

interface DiscountHandlerInterface
{
    public function applyDiscount(int $price, float $discountValue): int;
}