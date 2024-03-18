<?php

namespace App\Entity;

use App\Entity\Traits\ArchivedAtTrait;
use App\Entity\Traits\CreatedAtTrait;
use App\Entity\Traits\GeneratedIdTrait;
use App\Repository\CountryTaxRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;

/**
 * Сущность справочника "Налоговые ставки"
 * NOTE: Префикс в БД d_ указывает на принадлежность к справочникам.
 */
#[ORM\Entity(repositoryClass: CountryTaxRepository::class)]
#[ORM\Table(name: 'd_countries_tax')]
#[Index(name: 'd_countries_tax_rate_format_idx', columns: ['tax_rate', 'vat_format'])]
class CountryTax
{
    use GeneratedIdTrait;
    use CreatedAtTrait;
    use ArchivedAtTrait;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $taxRate = null;

    #[ORM\Column(length: 255)]
    private ?string $vatFormat = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Country $country = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getTaxRate(): ?string
    {
        return $this->taxRate;
    }

    public function setTaxRate(string $taxRate): static
    {
        $this->taxRate = $taxRate;

        return $this;
    }

    public function getVatFormat(): ?string
    {
        return $this->vatFormat;
    }

    public function setVatFormat(string $vatFormat): static
    {
        $this->vatFormat = $vatFormat;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): static
    {
        $this->country = $country;

        return $this;
    }
}
