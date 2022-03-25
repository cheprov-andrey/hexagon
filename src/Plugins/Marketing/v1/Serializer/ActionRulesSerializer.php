<?php

namespace App\Plugins\Marketing\v1\Serializer;

use App\Plugins\Marketing\Entity\ActionRules;

class ActionRulesSerializer
{
    public function create(array $actionRules) : array
    {
        $responseRules = [];
        /** @var ActionRules $actionRule */
        foreach ($actionRules as $actionRule) {
            $responseRules[]['id'] = $actionRule->getId();
        }
        return $responseRules;
    }
}
