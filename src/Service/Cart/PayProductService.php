<?php

namespace App\Service\Cart;

use App\Dto\ProductRequestDto;
use App\Entity\PaymentProvider;

use App\Exception\PaymentException;
use App\Service\PaymentProvider\PaymentProvider as PaymentProviderService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;

class PayProductService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly PaymentProviderService $paymentProvider,
        private readonly LoggerInterface $logger
    )
    {
    }

    /**
     * @param int $price
     * @param ProductRequestDto $dto
     * @return bool
     * @throws PaymentException
     * @throws \Doctrine\DBAL\Exception
     */
    public function paymentProduct(int $price, ProductRequestDto $dto): bool
    {

        $paymentProcessor = $this->entityManager->getRepository(PaymentProvider::class)->findOneBy(["name" => $dto->getPaymentProcessor()]);
        if ($paymentProcessor === null) {
            PaymentException::unsupportedPaymentType($dto->getPaymentProcessor());
        }

        $paymentProvider = $this->paymentProvider->getPaymentProvider($paymentProcessor->getName());

        // Транзакции, вдруг делаем списание со склада
        $this->entityManager->getConnection()->beginTransaction();
        try {
            $paymentProvider->pay($price);
            // TODO: Тут делаем запись в журнал Entity ProductTransaction
            $this->entityManager->getConnection()->commit();
            return true;
        } catch (Exception $e) {
            $this->entityManager->getConnection()->rollBack();
            // TODO: Логировать нужно в файл
            $this->logger->error("Pay Failed: {$e->getMessage()}");
            return false;
        }
    }
}