<?php

namespace App\Plugins\Common\Repository;

use Doctrine\ORM\EntityManagerInterface;

class BaseRepository
{
    protected EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function save()
    {
        $this->em->flush();
    }
}
