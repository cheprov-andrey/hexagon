<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class KernelResponseListener
{
    /**
     * @param ResponseEvent $event
     */
    public function onKernelResponse(ViewEvent $event)
    {
        $response = $event->getControllerResult();
        $event->setResponse(new JsonResponse([
            'message' => $response
        ]));
    }
}
