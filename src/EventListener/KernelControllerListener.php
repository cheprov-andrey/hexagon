<?php

namespace App\EventListener;

use App\AppAdapter\AppValidator;
use App\Plugins\Common\Controller\BaseController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;

class KernelControllerListener
{
    protected ContainerInterface $containerBuilder;
    private static bool $needExecute = true;

    public function __construct(ContainerInterface $containerBuilder)
    {
        $this->containerBuilder = $containerBuilder;
    }

    public function onKernelController(ControllerEvent $event)
    {
        $objController = $event->getController();
        if (!is_array($objController)) {

            return;
        }

        $action = $objController[1];
        $controller = $objController[0];
        if (!($controller instanceof BaseController)) {

            return;
        }

        if (!$this->runAuthorization($event, $controller, $action)) {

            return;
        }

        if (self::$needExecute) {
            $appValidator = AppValidator::getAppValidator();
            $this->containerBuilder->set(AppValidator::class, $appValidator);
        }

        self::$needExecute = false;
    }

    private function runAuthorization() : bool
    {
        return true;
    }
}
