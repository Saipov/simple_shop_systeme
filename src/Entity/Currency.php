<?php

namespace App\Entity;

use App\Entity\Traits\GeneratedIdTrait;
use App\Repository\CurrencyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;

/**
 * Сущность справочника "Валюты"
 * NOTE: Префикс в БД d_ указывает на принадлежность к справочникам.
 */
#[ORM\Entity(repositoryClass: CurrencyRepository::class)]
#[ORM\Table(name: "d_currencies")]
#[Index(name: "d_currencies_code_name_idx", columns: ["code", "name"])]
class Currency
{

    use GeneratedIdTrait;

    #[ORM\Column(length: 3, unique: true)]
    private ?string $code = null;

    #[ORM\Column(length: 10, unique: true)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: ProductPrice::class, mappedBy: 'currency')]
    private Collection $productPrices;

    public function __construct()
    {
        $this->productPrices = new ArrayCollection();
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, ProductPrice>
     */
    public function getProductPrices(): Collection
    {
        return $this->productPrices;
    }

    public function addProductPrice(ProductPrice $productPrice): static
    {
        if (!$this->productPrices->contains($productPrice)) {
            $this->productPrices->add($productPrice);
            $productPrice->setCurrency($this);
        }

        return $this;
    }

    public function removeProductPrice(ProductPrice $productPrice): static
    {
        if ($this->productPrices->removeElement($productPrice)) {
            // set the owning side to null (unless already changed)
            if ($productPrice->getCurrency() === $this) {
                $productPrice->setCurrency(null);
            }
        }

        return $this;
    }
}
