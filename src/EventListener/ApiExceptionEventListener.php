<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

/**
 * @NOTE Самый упрощенный вариант отлова ошибок
 * TODO: Нужно мапить поля чтоб была детализация ошибок
 */
#[AsEventListener(event: 'kernel.exception', priority: 5)]
class ApiExceptionEventListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $throwable = $event->getThrowable();

        if ($throwable instanceof HttpExceptionInterface) {
            $data = [
                'status' => Response::HTTP_BAD_REQUEST, // 400 по условиям задачи
                'message' => $throwable->getMessage(),
            ];
        } else {
            $data = [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $throwable->getMessage(),
            ];
        }
        $event->setResponse(new JsonResponse($data));
    }
}
