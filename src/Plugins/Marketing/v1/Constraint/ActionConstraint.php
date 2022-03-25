<?php

namespace App\Plugins\Marketing\v1\Constraint;

use App\AppAdapter\AppValidator;

class ActionConstraint
{
    public const CREATE_CONSTRAINT = [
        'name' => [
            AppValidator::LENGTH => [
                'min' => 2,
                'max' => 150
            ],
            AppValidator::NOT_NULL => null,
        ],
        'aboutAction'  => [
            AppValidator::NOT_NULL => null,
        ],
        'typeDiscount'  => [
            AppValidator::NOT_NULL => null,
        ],
        'weightDiscount'  => [
            AppValidator::NOT_NULL => null,
        ],
        'dateStart'  => [
            AppValidator::NOT_NULL => null,
        ],
        'dateEnd'  => [
            AppValidator::NOT_NULL => null,
        ],
        'rules'   => [
            AppValidator::NOT_NULL => null,
        ],
        'products'   => [
            AppValidator::NOT_NULL => null,
        ]
    ];
}
