<?php

namespace App\Plugins\Marketing\v1\Serializer;

use App\Plugins\Marketing\Entity\Action;

class ActionSerializer
{
    public function create(Action $action) : array
    {
        return [
            'id' => $action->getId()
        ];
    }
}
