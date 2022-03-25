<?php

namespace App\Plugins\Marketing\v1\Constraint;

use App\AppAdapter\AppValidator;

class ActionRulesConstraint
{
    public const CREATE_CONSTRAINT_WITH_ACTION = [
        'rule'  => [
            AppValidator::NOT_NULL => null,
        ],
    ];

    public const CREATE_CONSTRAINT = [
        'action' => [
            AppValidator::NOT_NULL => null
        ],
        'rule'  => [
            AppValidator::NOT_NULL => null,
        ],
    ];
}
