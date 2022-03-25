<?php

namespace App\Plugins\Common\Repository;

use App\Plugins\Common\Entity\BaseEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;

class BaseRepository extends ServiceEntityRepository
{
    public function save()
    {
        $this->_em->flush();
    }

    protected function findById(int $id, string $nameRepository) : ?BaseEntity
    {
        return $this
            ->_em
            ->getRepository($nameRepository)
            ->createQueryBuilder('p')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
