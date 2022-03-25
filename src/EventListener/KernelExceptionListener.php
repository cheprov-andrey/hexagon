<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class KernelExceptionListener
{
    public function onKernelException(ExceptionEvent $event) : void
    {
        $exception = $event->getThrowable();
        $response = new JsonResponse([$exception->getMessage()]);
        $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        $event->setResponse($response);
    }
}
