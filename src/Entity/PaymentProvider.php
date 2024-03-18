<?php

namespace App\Entity;

use App\Entity\Traits\GeneratedIdTrait;
use App\Repository\PaymentProviderRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;

/**
 * Сущность: "Платежные сервисы"
 *
 * NOTE: Будем предпологать, что пользователь может их добавлять через UI и есть SDK в коде
 */
#[ORM\Entity(repositoryClass: PaymentProviderRepository::class)]
#[ORM\Table(name: "payment_providers")]
#[Index(name: "payment_providers_name_idx", columns: ["name"])]
class PaymentProvider
{
    use GeneratedIdTrait;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @TODO: Нужно хешировать\шифровать
     * @var string|null
     */
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $apiKey = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    public function setApiKey(string $apiKey): static
    {
        $this->apiKey = $apiKey;

        return $this;
    }
}
