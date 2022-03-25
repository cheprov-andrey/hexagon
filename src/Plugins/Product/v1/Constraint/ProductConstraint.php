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
            ],
            'price'  => [
                AppValidator::NOT_NULL => null,
            ],
            'authors'  => [
                AppValidator::NOT_NULL => null,
            ]
        ];

    public const GET_CONSTRAINT = [
        'id' => [
            AppValidator::NOT_NULL => null,
        ],
    ];
}
