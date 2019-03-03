<?php

namespace Kusabi\Router;

/**
 * A parser aware object can set a retrieve a parser implementation
 *
 * @author Christian Harvey <christian.h@high-level-software.com>
 */
trait ParserAwareTrait
{
    /**
     * The parser held by this object
     *
     * @var ParserInterface
     */
    protected $parser;

    /**
     * Get the parser implementation
     *
     * @return ParserInterface|null
     */
    public function getParser(): ?ParserInterface
    {
        return $this->parser;
    }

    /**
     * Set the parser implementation
     *
     * @param ParserInterface $parser
     *
     * @return void
     */
    public function setParser(ParserInterface $parser): void
    {
        $this->parser = $parser;
    }
}
