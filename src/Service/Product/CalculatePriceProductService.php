<?php

namespace App\Service\Product;

use App\Dto\ProductRequestDto;
use App\Entity\CountryTax;
use App\Entity\ProductPrice;
use App\Exception\NotFoundProductException;
use App\Helper\ProductHelper;
use App\Service\Discount\DiscountProductService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CalculatePriceProductService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly DiscountProductService $discountProduct
    ) {
    }

    public function calculate(ProductRequestDto $dto): int
    {
        $product = $this->entityManager->getRepository(ProductPrice::class)->findPriceProductById($dto->getProduct());

        if (null === $product) {
            throw new NotFoundProductException();
        }

        // TODO: Нужно отделить расчет налога
        $taxRate = $this->getTaxRateByTaxNumber($dto->getTaxNumber());
        $price = $product->getPrice()->getAmount();

        if ($dto->getCouponCode()) {
            // TODO: Еще нужно валидировать принадлежность купона к продукту (есть связь ManyToMany)
            // TODO: Нужно валидировать ограничения по цифрам, вроде скидки в -110%
            $price = $this->discountProduct->applyDiscount($price, $dto->getCouponCode());
        }

        return $price + ($price * $taxRate / 100);
    }

    private function getTaxRateByTaxNumber($taxNumber): float
    {
        try {
            $taxRate = $this->entityManager->getRepository(CountryTax::class)
                ->findTaxRateByCountryCode2(ProductHelper::getCountryCodeByTax($taxNumber));

            return (float) $taxRate;
        } catch (\Throwable) {
            throw new BadRequestHttpException('Check the settings of the tax_rate directories');
        }
    }
}
