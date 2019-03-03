<?php

namespace Kusabi\Router\Exceptions;

use RuntimeException;
use Throwable;

class RouteNotFoundException extends RuntimeException
{
    public function __construct(string $message = '', int $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            'The URL supplied did not match any of the routes',
            $code,
            $previous
        );
    }
}
