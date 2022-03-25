<?php

namespace App\Plugins\Marketing\Repository;

use \App\Plugins\Common\Repository\BaseRepository;
use App\Plugins\Marketing\Entity\Action;
use Doctrine\Persistence\ManagerRegistry;

class ActionRepository extends BaseRepository
{
    private const REPOSITORY = Action::class;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, self::REPOSITORY);
    }

    public function getById(int $id) : ?Action
    {
        return $this->findById($id, self::REPOSITORY);
    }
}
