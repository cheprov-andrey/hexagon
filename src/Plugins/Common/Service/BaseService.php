<?php

namespace App\Plugins\Common\Service;

use App\AppAdapter\AppRequest;
use App\Plugins\Common\Entity\BaseEntity;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class BaseService
{
    protected EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
}
