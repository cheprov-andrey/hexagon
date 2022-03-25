<?php

namespace App\EventListener;

use App\Plugins\Log\Entity\Log;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\TerminateEvent;

class KernelTerminateListener
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function onKernelFinishRequest(TerminateEvent $event)
    {
        $response = $event->getResponse();
        $statusEvent = $response->getStatusCode();
        if ($statusEvent !== Response::HTTP_OK) {
            $message = json_decode($response->getContent());
            $log = new Log();
            $log->setMessage($message[0]);
            $this->em->persist($log);
            $this->em->flush($log);
        }
    }
}
