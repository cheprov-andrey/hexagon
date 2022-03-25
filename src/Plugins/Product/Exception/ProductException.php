<?php

namespace App\Plugins\Product\Exception;

use Exception;
use Throwable;

class ProductException extends Exception
{
        public function __construct($message = "", $code = 0, Throwable $previous = null)
        {
            parent::__construct($message, $code, $previous);
        }
}
