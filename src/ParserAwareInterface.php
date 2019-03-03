<?php

namespace Kusabi\Router;

/**
 * A parser aware object can set a retrieve a parser implementation
 *
 * @author Christian Harvey <christian.h@high-level-software.com>
 */
interface ParserAwareInterface
{
    /**
     * Get the parser implementation
     *
     * @return ParserInterface|null
     */
    public function getParser(): ?ParserInterface;

    /**
     * Set the parser implementation
     *
     * @param ParserInterface $parser
     *
     * @return void
     */
    public function setParser(ParserInterface $parser): void;
}
