<?php

namespace Kusabi\Router;

use Kusabi\Router\Exceptions\MatchNotFoundException;

/**
 * A parser is responsible for determine if a route pattern matches the supplied uri.
 *
 * If so, it must also be able to parse any variables from the uri using the pattern.
 *
 * @author Christian Harvey <christian.h@high-level-software.com>
 */
interface ParserInterface
{
    /**
     * Does the url provided match the pattern provided?
     *
     * @param string $url
     * @param string $pattern
     *
     * @return bool
     */
    public function matches($url, $pattern): bool;

    /**
     * Parse the variables from the uri with a routes pattern
     *
     * @param string $url
     * @param string $pattern
     *
     * @throws MatchNotFoundException if the uri and pattern do not match
     *
     * @return array
     */
    public function parse($url, $pattern): array;
}
