<?php

namespace App\Exception;

class PaymentException extends \Exception
{
    /**
     * @throws PaymentException
     */
    public static function payException(string $message): self
    {
        throw new self(sprintf('Payment error message: %s', $message));
    }

    /**
     * @throws PaymentException
     */
    public static function unsupportedPaymentType(string $type): self
    {
        throw new self(sprintf('Unsupported payment processor type: %s', $type));
    }
}
