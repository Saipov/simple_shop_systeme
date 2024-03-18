<?php

namespace App\Helper;

use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;
class ProductHelper
{

    /**
     * @param string $taxNumber
     * @return string
     */
    public static function getCountryCodeByTax(string $taxNumber): string
    {
        return substr($taxNumber, 0, 2);
    }

    /**
     * @param int $value
     * @param string $currency
     * @return string
     */
    public static function formatMoney(int $value, string $currency = "EUR"): string
    {
        $money = new Money($value, new Currency($currency));
        $currencies = new ISOCurrencies();

        $moneyFormatter = new DecimalMoneyFormatter($currencies);

        return $moneyFormatter->format($money);
    }
}