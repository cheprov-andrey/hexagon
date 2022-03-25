<?php

namespace App\Plugins\Marketing\Service;

use App\Plugins\Common\Service\BaseService;
use App\Plugins\Marketing\Entity\Action;
use App\Plugins\Marketing\Entity\ActionRules;
use Doctrine\ORM\EntityManagerInterface;

class ActionRulesService extends BaseService
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em);
    }

    public function create(Action $action, array $arrRules) : void
    {
        $rules = [];
        foreach ($arrRules as $dataRule) {
            $rule = new ActionRules();
            $rule->setAction($action);
            $rule->setRule($dataRule);
            $this->em->persist($rule);
            $rules[] = $rule;
        }

        $this->em->flush($rules);
    }
}
