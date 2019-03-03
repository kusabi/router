<?php

namespace Kusabi\Router\Exceptions;

use InvalidArgumentException;
use Throwable;

class InvalidVerbException extends InvalidArgumentException
{
    public function __construct(string $verb = '', int $code = 0, Throwable $previous = null)
    {
        parent::__construct("The HTTP verb '{$verb}' is not supported", $code, $previous);
    }
}
