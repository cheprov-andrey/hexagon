<?php

namespace App\EventListener;

use App\AppAdapter\AppRequest;
use App\CommonInterface\RequestInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class KernelRequestListener
{
    protected ContainerInterface $containerBuilder;
    private static bool $needExecute = true;

    public function __construct(ContainerInterface $containerBuilder)
    {
        $this->containerBuilder = $containerBuilder;
    }

    public function onKernelRequest(RequestEvent $event) : void
    {
        if (self::$needExecute) {
            $appRequest = AppRequest::getRequest($event->getRequest());
            $this->containerBuilder->set(AppRequest::class, $appRequest);
        }

        self::$needExecute = false;
    }
}
