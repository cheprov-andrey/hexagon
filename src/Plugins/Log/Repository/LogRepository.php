<?php

namespace App\Plugins\Log\Repository;

use App\Plugins\Common\Repository\BaseRepository;
use App\Plugins\Log\Entity\Log;
use Doctrine\Persistence\ManagerRegistry;

class LogRepository extends BaseRepository
{
    private const REPOSITORY = Log::class;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, self::REPOSITORY);
    }
}
