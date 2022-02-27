<?php

namespace App\Plugins\Product\v1\Constraint;

use App\AppAdapter\AppValidator;

class ProductConstraint
{
    public const CREATE_CONSTRAINT = [
            'name' => [
                AppValidator::LENGTH => [
                    'min' => 2,
                    'max' => 150
                ],
                AppValidator::NOT_NULL => null,
            ],
            'weight'  => [
                AppValidator::NOT_NULL => null,
            ]
        ];
}
