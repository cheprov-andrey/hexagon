<?php

namespace App\Plugins\Product\Repository;

use App\Plugins\Common\Repository\BaseRepository;
use App\Plugins\Product\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;

class ProductRepository extends BaseRepository
{
    private const REPOSITORY = Product::class;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, self::REPOSITORY);
    }

    public function getById(int $id) : ?Product
    {
        return $this->findById($id, self::REPOSITORY);
    }
}
