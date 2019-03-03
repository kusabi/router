<?php

namespace Kusabi\Router\Parsers;

use Kusabi\Router\ParserInterface;

/**
 * A more user-friendly parser that implements some shorthand regular expressions.
 *
 * As it still extends the regular expression parser, regular expressions can still be used here.
 *
 * @author Christian Harvey <christian.h@high-level-software.com>
 */
class FriendlyParser extends RegexParser implements ParserInterface
{
    /**
     * {@inheritdoc}
     */
    protected function prepare(string $pattern): string
    {
        // Replace :any
        $pattern = preg_replace('/{:any}/', '(.*)', $pattern);

        // Replace :int
        $pattern = preg_replace('/{:int}/', '([0-9]+(?=\/?))', $pattern);

        // Replace :float
        $pattern = preg_replace('/{:float}/', '([0-9.]+(?=\/?))', $pattern);

        // Replace :number
        $pattern = preg_replace('/{:number}/', '([\d]+(?=\/?))', $pattern);

        // Replace :alpha
        $pattern = preg_replace('/{:alpha}/', '([a-zA-Z]+(?=\/?))', $pattern);

        // Replace :alpha-numeric
        $pattern = preg_replace('/{:alpha-numeric}/', '(\w+(?=\/?))', $pattern);

        // Replace curly brace parameters with regex
        $pattern = preg_replace('/{([^:].*?)}/', '([^\/\n]+(?=\/?))', $pattern);

        // Replace slashes without escapes
        $pattern = preg_replace('/(?<!\\\)\//', '\/', $pattern);

        // return the regex pattern
        return parent::prepare("^\/?{$pattern}$");
    }
}
