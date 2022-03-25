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

    public function create(AppRequest $request, array $products): Action
    {
        $action = new Action();
        $action->setName($request->get('name'));
        $action->setAboutAction($request->get('aboutAction'));
        $action->setTypeDiscount($request->get('typeDiscount'));
        $action->setWeightDiscount($request->get('weightDiscount'));
        $action->setDateStart($request->get('dateStart'));
        $action->setDateEnd($request->get('dateEnd'));
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
