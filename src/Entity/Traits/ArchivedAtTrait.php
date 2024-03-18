<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait ArchivedAtTrait
{

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    protected \DateTimeImmutable $archivedAt;

    public function setArchivedAt(\DateTimeImmutable $archivedAt): static
    {
        $this->archivedAt = $archivedAt;

        return $this;
    }

    public function getArchivedAt(): \DateTimeImmutable
    {
        return $this->archivedAt;
    }
}