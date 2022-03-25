<?php

namespace App\Plugins\Marketing\Repository;

use App\Plugins\Common\Repository\BaseRepository;
use App\Plugins\Marketing\Entity\ActionRules;
use Doctrine\Persistence\ManagerRegistry;

class ActionRulesRepository extends BaseRepository
{
    private const REPOSITORY = ActionRules::class;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, self::REPOSITORY);
    }
}
