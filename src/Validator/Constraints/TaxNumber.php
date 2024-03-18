<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class TaxNumber extends Constraint
{
    public string $message = 'The tax number "{{ tax_number }}" is not a valid.';

    public function validatedBy(): string
    {
        return static::class.'Validator';
    }
}
