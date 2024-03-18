<?php

namespace App\Service\PaymentProvider;

use App\Exception\PaymentException;

class PaymentProvider
{
    public function __construct(private readonly iterable $paymentProvider)
    {
    }

    /**
     * @throws PaymentException
     */
    public function getPaymentProvider(string $paymentName): PaymentProviderInterface
    {
        /** @var PaymentProviderInterface $paymentProvider */
        foreach ($this->paymentProvider as $paymentProvider) {
            if ($paymentProvider->support($paymentName)) {
                return $paymentProvider;
            }
        }

        PaymentException::unsupportedPaymentType($paymentName);
    }
}
