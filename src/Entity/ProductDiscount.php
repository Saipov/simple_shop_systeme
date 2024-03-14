<?php

namespace App\Entity;

use App\Entity\Traits\ArchivedAtTrait;
use App\Entity\Traits\CreatedAtTrait;
use App\Entity\Traits\DeletedAtTrait;
use App\Entity\Traits\GeneratedIdTrait;
use App\Enum\ProductDiscountTypeEnum;
use App\Repository\ProductDiscountRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;

/**
 * Сущность: "Купоны, дисконтная программа"
 *
 * NOTE: Упрощенный вариант, без валидации старта дисконтной программы
 */
#[ORM\Entity(repositoryClass: ProductDiscountRepository::class)]
#[ORM\Table(name: 'products_discount')]
#[Index(name: "products_discount_idx", columns: ["coupon_code", "value"])]
class ProductDiscount
{
    use GeneratedIdTrait;
    use CreatedAtTrait;
    use ArchivedAtTrait;
    use DeletedAtTrait;

    #[ORM\Column(length: 255)]
    private ?string $coupon_code = null;

    #[ORM\Column(type: Types::STRING, length: 255, enumType: ProductDiscountTypeEnum::class)]
    private ProductDiscountTypeEnum $coupon_type = ProductDiscountTypeEnum::PERCENT;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, options: ['unsigned' => true])]
    private ?string $value = null;

    #[ORM\Column(type: Types::BOOLEAN, nullable: false, options: ['default' => false])]
    private ?bool $is_active = false;

    #[ORM\Column]
    private ?\DateTimeImmutable $date_start = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $date_end = null;

    #[ORM\ManyToOne(inversedBy: 'productDiscounts')]
    private ?Product $product = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getCouponCode(): ?string
    {
        return $this->coupon_code;
    }

    public function setCouponCode(string $coupon_code): static
    {
        $this->coupon_code = $coupon_code;

        return $this;
    }

    public function getCouponType(): ProductDiscountTypeEnum
    {
        return $this->coupon_type;
    }

    public function setCouponType(ProductDiscountTypeEnum $coupon_type): static
    {
        $this->coupon_type = $coupon_type;

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
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): static
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getDateStart(): ?\DateTimeImmutable
    {
        return $this->date_start;
    }

    public function setDateStart(\DateTimeImmutable $date_start): static
    {
        $this->date_start = $date_start;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeImmutable
    {
        return $this->date_end;
    }

    public function setDateEnd(?\DateTimeImmutable $date_end): static
    {
        $this->date_end = $date_end;

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
}
