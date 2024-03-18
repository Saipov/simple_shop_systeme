<?php

namespace App\Service\PaymentProvider;

use App\Exception\PaymentException;
use App\Helper\ProductHelper;
use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;
use Throwable;

class StripePaymentProvider implements PaymentProviderInterface
{

    const PAYMENT_NAME = 'stripe';
    private readonly StripePaymentProcessor $stripePaymentProcessor;

    public function __construct()
    {
        $this->stripePaymentProcessor = new StripePaymentProcessor();
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
            // Допустим страйп принимает не центы. Конвертим центы в евро
            $price = (float)ProductHelper::formatMoney($price);
            return $this->stripePaymentProcessor->processPayment($price);
        } catch (Throwable $exception) {
            throw PaymentException::payException($exception->getMessage());
        }
    }
}