<?php

namespace App\Plugins\Marketing\Service;

use App\AppAdapter\AppRequest;
use App\Plugins\Common\Service\BaseService;
use App\Plugins\Marketing\Entity\Action;
use App\Plugins\Marketing\Repository\ActionRepository;
use Doctrine\ORM\EntityManagerInterface;

class ActionService extends BaseService
{
    private ActionRepository $actionRepository;

    public function __construct(
        EntityManagerInterface $em,
        ActionRepository $actionRepository
    )
    {
        parent::__construct($em);
        $this->actionRepository = $actionRepository;
    }

    public function create(array $attributes, array $products): Action
    {
        $action = new Action();
        $action->setName($attributes['name']);
        $action->setAboutAction($attributes['aboutAction']);
        $action->setTypeDiscount($attributes['typeDiscount']);
        $action->setWeightDiscount($attributes['weightDiscount']);
        $action->setDateStart($attributes['dateStart']);
        $action->setDateEnd($attributes['dateEnd']);
        $action->setProducts($products);
        $this->em->persist($action);
        $this->em->flush($action);
        return $action;
    }

    public function find(int $actionId) : ?Action
    {
        return $this->actionRepository->getById($actionId);
    }
}
