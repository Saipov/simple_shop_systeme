<?php

namespace App\Dto;

use App\Validator\Constraints\TaxNumber;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class ProductRequestDto
{
    public function __construct(

        #[Type('integer')]
        #[NotBlank(message: 'Product id is required field')]
        public readonly int $product,

        #[Type('string')]
        #[NotBlank(message: 'Tax number is required field')]
        #[TaxNumber]
        public readonly string $taxNumber,

        #[Type('string')]
        public readonly ?string $couponCode,

        #[Type('string')]
        public readonly ?string $paymentProcessor,
    ) {
    }

    public function getProduct(): int
    {
        return $this->product;
    }
    public function getTaxNumber(): string
    {
        return $this->taxNumber;
    }

    public function getCouponCode(): ?string
    {
        return $this->couponCode;
    }

    public function getPaymentProcessor(): ?string
    {
        return $this->paymentProcessor;
    }
}