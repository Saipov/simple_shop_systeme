<?php

namespace App\Service\PaymentProvider;

use App\Exception\PaymentException;
use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;
use Throwable;

class PaypalPaymentProvider implements PaymentProviderInterface
{

    const PAYMENT_NAME = 'paypal';
    private readonly PaypalPaymentProcessor $paypalPaymentProcessor;

    public function __construct()
    {
        $this->paypalPaymentProcessor = new PaypalPaymentProcessor();
    }

    /**
     * @param string $paymentName
     * @return bool
     */
    public function support(string $paymentName): bool
    {
        return $paymentName === self::PAYMENT_NAME;
    }

    /**
     * @param int $price
     * @return bool
     * @throws PaymentException
     */
    public function pay(int $price): bool
    {
        try {
            $this->paypalPaymentProcessor->pay($price);
        } catch (Throwable $exception) {
            throw PaymentException::payException($exception->getMessage());
        }

        return true;
    }
}