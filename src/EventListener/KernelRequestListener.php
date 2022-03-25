<?php

namespace App\EventListener;

use App\AppAdapter\AppRequest;
use App\CommonInterface\RequestInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
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
            $content = $this->getContentForRequest();
            if (!is_null($content) && is_array($content)) {
                $post = $this->prepareDataRequest($content);
            } else {
                if (!is_null($event->getRequest()->getContent())) {
                    $post = array_merge(json_decode($event->getRequest()->getContent(), true), $_POST ?? []);
                } else {
                    $post = $_POST;
                }
            }

            $appRequest = AppRequest::getRequest(new Request($_GET, $post, [], $_COOKIE, $_FILES, $event->getRequest()->server->all()));
            $this->containerBuilder->set(AppRequest::class, $appRequest);
        }

        self::$needExecute = false;
    }

    private function getContentForRequest() : ?array
    {
        $content = file_get_contents('php://input');
        if (!is_null($content) || $content === "") {
            return json_decode($content, true);
        }

        return null;
    }

    private function prepareDataRequest(array $content) : array
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        if ($requestMethod == 'POST') {
            return array_merge($_POST, $content);
        }

        return $_POST;
    }
}
