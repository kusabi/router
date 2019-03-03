<?php

namespace Kusabi\Router\Parsers;

use Kusabi\Router\Exceptions\MatchNotFoundException;
use Kusabi\Router\ParserInterface;

/**
 * An exact parser is fairly useless in the real world and serves only as an example of how to create a custom parser.
 *
 * @author Christian Harvey <christian.h@high-level-software.com>
 */
class ExactParser implements ParserInterface
{
    /**
     * {@inheritdoc}
     */
    public function matches($url, $pattern): bool
    {
        $url = implode('/', array_filter(explode('/', $url)));
        $pattern = implode('/', array_filter(explode('/', $pattern)));
        return $url == $pattern;
    }

    /**
     * {@inheritdoc}
     */
    public function parse($url, $pattern): array
    {
        if (!$this->matches($url, $pattern)) {
            throw new MatchNotFoundException($url, $pattern);
        }
        return [];
    }
}
