<?php

namespace App\Entity;

use App\Entity\Traits\GeneratedIdTrait;
use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;

/**
 * Сущность справочника "Страны"
 * NOTE: Префикс в БД d_ указывает на принадлежность к справочникам.
 */
#[ORM\Entity(repositoryClass: CountryRepository::class)]
#[ORM\Table(name: 'd_countries')]
#[Index(name: "d_countries_code2_name_idx", columns: ["code2", "name"])]
class Country
{
    use GeneratedIdTrait;

    #[ORM\Column(length: 2, unique: true)]
    private ?string $code2 = null;

    #[ORM\Column(length: 10, unique: true)]
    private ?string $name = null;

    public function getCode2(): ?string
    {
        return $this->code2;
    }

    public function setCode2(string $code2): static
    {
        $this->code2 = $code2;

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
}
