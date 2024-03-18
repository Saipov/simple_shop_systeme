<?php

namespace App\Controller\Api\v1;

use App\Dto\ProductRequestDto;
use App\Service\Cart\PayProductService;
use App\Service\Product\CalculatePriceProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/api/v1", "api_")]
class CartController extends AbstractController
{
    public function __construct(
        private readonly CalculatePriceProductService $calculatePriceProductService,
        private readonly PayProductService $payProductService
    )
    {
    }

    #[Route('/purchase', name: 'app_cart', methods: ["POST"])]
    public function index(#[MapRequestPayload] ProductRequestDto $dto): JsonResponse
    {
        $price = $this->calculatePriceProductService->calculate($dto);
        $status = $this->payProductService->paymentProduct($price, $dto);
        return $this->json(["payStatus" => $status]);
    }
}
