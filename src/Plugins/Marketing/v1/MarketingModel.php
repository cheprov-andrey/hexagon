<?php

namespace App\Plugins\Marketing\v1;

use App\AppAdapter\AppRequest;
use App\Plugins\Marketing\Service\ActionRulesService;
use App\Plugins\Marketing\Service\ActionService;
use App\Plugins\Product\Service\ProductService;
use Doctrine\ORM\EntityManagerInterface;

class MarketingModel
{
    private EntityManagerInterface $em;
    private ProductService $productService;
    private ActionService $actionService;
    private ActionRulesService $actionRulesService;

    public function __construct(
        EntityManagerInterface $em,
        ProductService $productService,
        ActionService $actionService,
        ActionRulesService $actionRulesService
    )
    {
        $this->em = $em;
        $this->productService = $productService;
        $this->actionService = $actionService;
        $this->actionRulesService = $actionRulesService;
    }

    public function create(AppRequest $request) : void
    {
        $products = $this->productService->findByArrayId($request->get('products'));
        $this->em->beginTransaction();
        $action = $this->actionService->create($request, $products);
        $this->actionRulesService->create($action, $request->get('rules'));
        $this->em->commit();
    }

    public function createRules(AppRequest $request) : void
    {
        $action = $this->actionService->find($request->get('action'));
        $this->actionRulesService->create($action, $request->get('rule'));
    }
}
