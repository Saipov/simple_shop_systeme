<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

class NotFoundProductException extends HttpException
{
    public function __construct()
    {
        parent::__construct(400, 'Product not found');
    }
}
