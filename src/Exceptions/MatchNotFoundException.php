<?php

namespace Kusabi\Router\Exceptions;

use RuntimeException;
use Throwable;

class MatchNotFoundException extends RuntimeException
{
    /**
     * MatchNotFoundException constructor.
     *
     * @param string $url
     * @param string $pattern
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $url, string $pattern, int $code = 0, Throwable $previous = null)
    {
        parent::__construct("The url '{$url}' did not match the pattern '{$pattern}'", $code, $previous);
    }
}
