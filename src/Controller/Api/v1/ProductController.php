<?php

namespace App\Controller\Api\v1;

use App\Dto\ProductRequestDto;
use App\Helper\ProductHelper;
use App\Service\Product\CalculatePriceProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1', 'api_')]
class ProductController extends AbstractController
{
    public function __construct(
        private readonly CalculatePriceProductService $calculatePriceProductService,
    ) {
    }

    #[Route('/calculate-price', name: 'app_product', methods: ['POST'])]
    public function calculatePrice(#[MapRequestPayload] ProductRequestDto $dto): JsonResponse
    {
        // TODO: Нужно еще поля выводить (productName etc.), например через нормализатор и dto
        $price = $this->calculatePriceProductService->calculate($dto);

        return $this->json(['totalPrice' => ProductHelper::formatMoney($price)]);
    }
}
