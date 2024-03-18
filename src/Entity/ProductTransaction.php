<?php

namespace App\Entity;

use App\Entity\Traits\ArchivedAtTrait;
use App\Entity\Traits\CreatedAtTrait;
use App\Entity\Traits\GeneratedIdTrait;
use App\Repository\ProductTransactionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Сущность: "Журнал покупок"
 *
 * NOTE: Упрощенный вариант
 */
#[ORM\Entity(repositoryClass: ProductTransactionRepository::class)]
#[ORM\Table(name: 'products_transaction')]
class ProductTransaction
{
    use GeneratedIdTrait;
    use CreatedAtTrait;
    use ArchivedAtTrait;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    private ?string $amount = null;

    #[ORM\ManyToOne(inversedBy: 'productTransactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?PaymentProvider $paymentProvider = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getPaymentProvider(): ?PaymentProvider
    {
        return $this->paymentProvider;
    }

    public function setPaymentProvider(?PaymentProvider $paymentProvider): static
    {
        $this->paymentProvider = $paymentProvider;

        return $this;
    }
}
