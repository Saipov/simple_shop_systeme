<?php

namespace App\Validator\Constraints;

use App\Entity\CountryTax;
use App\Helper\ProductHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TaxNumberValidator extends ConstraintValidator
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    )
    {
    }
    public function validate($value, Constraint $constraint): void
    {
        if (null === $value || '' === $value) {
            return;
        }

        if (!$this->isTaxNumberValid($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ tax_number }}', $value)
                ->addViolation();
        }
    }

    /**
     * @param string $taxNumber
     * @return bool
     */
    private function isTaxNumberValid(string $taxNumber): bool
    {
        $vatFormat = $this->entityManager->getRepository(CountryTax::class)
            ->findVatFormatByCountryCode2(ProductHelper::getCountryCodeByTax($taxNumber));

        $regex = $this->convertFormatToRegex($vatFormat);

        return preg_match($regex, $taxNumber) === 1;
    }

    /**
     * @param $format
     * @return string
     */
    private function convertFormatToRegex($format): string
    {
        $format = str_replace('X', '[0-9]', $format);
        $format = str_replace('Y', '[A-Za-z]', $format);

        return "/^" . $format . "$/";
    }
}