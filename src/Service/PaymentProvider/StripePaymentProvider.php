<?php

namespace App\Service\PaymentProvider;

use App\Exception\PaymentException;
use App\Helper\ProductHelper;
use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;

class StripePaymentProvider implements PaymentProviderInterface
{
    public const PAYMENT_NAME = 'stripe';
    private readonly StripePaymentProcessor $stripePaymentProcessor;

    public function __construct()
    {
        $this->stripePaymentProcessor = new StripePaymentProcessor();
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
            // Допустим страйп принимает не центы. Конвертим центы в евро
            $price = (float) ProductHelper::formatMoney($price);

            return $this->stripePaymentProcessor->processPayment($price);
        } catch (\Throwable $exception) {
            throw PaymentException::payException($exception->getMessage());
        }
    }
}
