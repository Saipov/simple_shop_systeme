<?php

namespace App\Service\PaymentProvider;

use App\Exception\PaymentException;
use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;

class PaypalPaymentProvider implements PaymentProviderInterface
{
    public const PAYMENT_NAME = 'paypal';
    private readonly PaypalPaymentProcessor $paypalPaymentProcessor;

    public function __construct()
    {
        $this->paypalPaymentProcessor = new PaypalPaymentProcessor();
    }

    public function support(string $paymentName): bool
    {
        return self::PAYMENT_NAME === $paymentName;
    }

    /**
     * @throws PaymentException
     */
    public function pay(int $price): bool
    {
        try {
            $this->paypalPaymentProcessor->pay($price);
        } catch (\Throwable $exception) {
            throw PaymentException::payException($exception->getMessage());
        }

        return true;
    }
}
