<?php

declare(strict_types=1);

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $response = new JsonResponse([
            'error' => [
                'code' => $exception->getStatusCode(),
                'message' => $exception->getMessage(),
            ]
        ], $exception->getStatusCode() ?: 500);

        $event->setResponse($response);
    }
}
