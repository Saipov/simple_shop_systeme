<?php

namespace App\Entity;

use App\Entity\Traits\ArchivedAtTrait;
use App\Entity\Traits\GeneratedIdTrait;
use App\Entity\ValueObject\Money;
use App\Repository\ProductPriceRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embedded;
use Doctrine\ORM\Mapping\Index;

/**
 * Сущность: "Цены товаров"
 *
 * NOTE: Упрощенный вариант
 * TODO: Мы не должны удалять цены, как вариант нужно отлавливать события апдейта и создавать новую запись. Нужно для аналитики и отчетов
 */
#[ORM\Entity(repositoryClass: ProductPriceRepository::class)]
#[ORM\Table(name: 'products_price')]
#[Index(name: "products_price_idx", columns: ["price"])]
class ProductPrice
{

    use GeneratedIdTrait;
    use ArchivedAtTrait;

    #[Embedded(class: "App\Entity\ValueObject\Money", columnPrefix: false)]
    private Money $price;

    #[ORM\ManyToOne(inversedBy: 'productPrices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[ORM\ManyToOne(inversedBy: 'productPrices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Currency $currency = null;

    public function getPrice(): Money
    {
        return $this->price;
    }

    public function setPrice(?Money $price): static
    {
        $this->price = $price;

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

    public function getCurrency(): ?Currency
    {
        return $this->currency;
    }

    public function setCurrency(?Currency $currency): static
    {
        $this->currency = $currency;

        return $this;
    }
}
