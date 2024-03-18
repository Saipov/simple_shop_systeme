<?php

namespace App\Service\Discount;

class DiscountHandler
{
    /**
     * TODO: Захардкожено [PERCENT и т.д], можно переделать.
     */
    public static function getDiscountType(string $type): DiscountHandlerFixed|DiscountHandlerPercentage
    {
        return match ($type) {
            'PERCENT' => new DiscountHandlerPercentage(),
            'FIXED' => new DiscountHandlerFixed()
        };
    }
}
