<?php

namespace Kusabi\Router\Parsers;

use Kusabi\Router\Exceptions\MatchNotFoundException;
use Kusabi\Router\ParserInterface;

/**
 * A regular expression parser that allows the user to supply regular expressions as their pattern
 *
 * @author Christian Harvey <christian.h@high-level-software.com>
 */
class RegexParser implements ParserInterface
{
    /**
     * {@inheritdoc}
     */
    public function matches($url, $pattern): bool
    {
        return preg_match($this->prepare($pattern), $url);
    }

    /**
     * {@inheritdoc}
     */
    public function parse($url, $pattern): array
    {
        if (preg_match_all($this->prepare($pattern), $url, $matches)) {
            array_shift($matches);
            return array_column($matches, 0);
        }
        throw new MatchNotFoundException($url, $pattern);
    }

    /**
     * Prepare the regex pattern
     *
     * @param string $pattern
     *
     * @return string
     */
    protected function prepare(string $pattern) : string
    {
        return '/'.$pattern.'/';
    }
}
