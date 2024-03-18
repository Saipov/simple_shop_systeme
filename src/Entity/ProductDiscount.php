<?php

namespace App\Entity;

use App\Entity\Traits\ArchivedAtTrait;
use App\Entity\Traits\CreatedAtTrait;
use App\Entity\Traits\DeletedAtTrait;
use App\Entity\Traits\GeneratedIdTrait;
use App\Enum\ProductDiscountTypeEnum;
use App\Repository\ProductDiscountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Сущность: "Купоны, дисконтная программа".
 *
 * NOTE: Упрощенный вариант, без валидации старта дисконтной программы
 */
#[ORM\Entity(repositoryClass: ProductDiscountRepository::class)]
#[ORM\Table(name: 'products_discount')]
#[Index(name: 'products_discount_idx', columns: ['coupon_code', 'value'])]
#[UniqueConstraint(
    name: 'products_discount_coupon_code_unique_idx',
    columns: ['coupon_code']
)]
class ProductDiscount
{
    use GeneratedIdTrait;
    use CreatedAtTrait;
    use ArchivedAtTrait;
    use DeletedAtTrait;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $couponCode = null;

    #[ORM\Column(type: Types::STRING, length: 255, enumType: ProductDiscountTypeEnum::class)]
    private ProductDiscountTypeEnum $couponType;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, options: ['unsigned' => true])]
    private ?string $value = null;

    #[ORM\Column(type: Types::BOOLEAN, nullable: false, options: ['default' => false])]
    private ?bool $isActive = false;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateStart = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $dateEnd = null;

    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'productDiscounts')]
    private Collection $products;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->couponType = ProductDiscountTypeEnum::PERCENT;
        $this->products = new ArrayCollection();
    }

    public function getCouponCode(): ?string
    {
        return $this->couponCode;
    }

    public function setCouponCode(string $couponCode): static
    {
        $this->couponCode = $couponCode;

        return $this;
    }

    public function getCouponType(): ProductDiscountTypeEnum
    {
        return $this->couponType;
    }

    public function setCouponType(ProductDiscountTypeEnum $couponType): static
    {
        $this->couponType = $couponType;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

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

    public function getDateStart(): ?\DateTimeImmutable
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTimeImmutable $dateStart): static
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeImmutable
    {
        return $this->dateEnd;
    }

    public function setDateEnd(?\DateTimeImmutable $dateEnd): static
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        $this->products->removeElement($product);

        return $this;
    }
}
