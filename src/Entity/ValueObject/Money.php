<?php

namespace App\Entity\ValueObject;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Parser\DecimalMoneyParser;

#[Embeddable]
class Money
{
    #[Column(type: Types::BIGINT, options: ['unsigned' => true])]
    private int $price;

    public function __construct(string $amounts, string $currency)
    {
        $currencies = new ISOCurrencies();
        $moneyParser = new DecimalMoneyParser($currencies);
        $money = $moneyParser->parse($amounts, new Currency($currency));

        $this->price = $money->getAmount();
    }

    public function getAmount(): ?int
    {
        return $this->price;
    }
}
