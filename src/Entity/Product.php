<?php

namespace App\Entity;

use App\Entity\Traits\ArchivedAtTrait;
use App\Entity\Traits\CreatedAtTrait;
use App\Entity\Traits\DeletedAtTrait;
use App\Entity\Traits\GeneratedIdTrait;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;

/**
 * Сущность: "Товары"
 *
 * NOTE: Упрощенный вариант, без количества, складов и т.п. Применяем soft delete и отправку в архив
 * - это нужно для отчетов, аналитики и т.п.
 */
#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\Table(name: "products")]
#[Index(name: "products_name_idx", columns: ["name"])]
class Product
{

    use GeneratedIdTrait;
    use CreatedAtTrait;
    use ArchivedAtTrait;
    use DeletedAtTrait;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->productPrices = new ArrayCollection();
        $this->productTransactions = new ArrayCollection();
        $this->productDiscounts = new ArrayCollection();
    }

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::BOOLEAN, nullable: false, options: ['default' => false])]
    private bool $isActive = false;

    #[ORM\OneToMany(targetEntity: ProductPrice::class, mappedBy: 'product')]
    private Collection $productPrices;

    #[ORM\OneToMany(targetEntity: ProductTransaction::class, mappedBy: 'product')]
    private Collection $productTransactions;

    #[ORM\ManyToMany(targetEntity: ProductDiscount::class, mappedBy: 'products')]
    private Collection $productDiscounts;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

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
            $productPrice->setProduct($this);
        }

        return $this;
    }

    public function removeProductPrice(ProductPrice $productPrice): static
    {
        if ($this->productPrices->removeElement($productPrice)) {
            // set the owning side to null (unless already changed)
            if ($productPrice->getProduct() === $this) {
                $productPrice->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProductTransaction>
     */
    public function getProductTransactions(): Collection
    {
        return $this->productTransactions;
    }

    public function addProductTransaction(ProductTransaction $productTransaction): static
    {
        if (!$this->productTransactions->contains($productTransaction)) {
            $this->productTransactions->add($productTransaction);
            $productTransaction->setProduct($this);
        }

        return $this;
    }

    public function removeProductTransaction(ProductTransaction $productTransaction): static
    {
        if ($this->productTransactions->removeElement($productTransaction)) {
            // set the owning side to null (unless already changed)
            if ($productTransaction->getProduct() === $this) {
                $productTransaction->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProductDiscount>
     */
    public function getProductDiscounts(): Collection
    {
        return $this->productDiscounts;
    }

    public function addProductDiscount(ProductDiscount $productDiscount): static
    {
        if (!$this->productDiscounts->contains($productDiscount)) {
            $this->productDiscounts->add($productDiscount);
            $productDiscount->addProduct($this);
        }

        return $this;
    }

    public function removeProductDiscount(ProductDiscount $productDiscount): static
    {
        if ($this->productDiscounts->removeElement($productDiscount)) {
            $productDiscount->removeProduct($this);
        }

        return $this;
    }
}
