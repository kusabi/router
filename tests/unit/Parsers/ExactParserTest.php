<?php

namespace Parsers;

use Kusabi\Router\ParserInterface;
use Kusabi\Router\Parsers\ExactParser;

class ExactParserTest extends \Codeception\Test\Unit
{
    /**
     * @var ExactParser
     */
    protected $parser;

    protected function _before()
    {
        $this->parser = new ExactParser();
    }

    protected function _after()
    {
    }

    public function testInstanceOfParserInterface()
    {
        $this->assertInstanceOf(ParserInterface::class, $this->parser);
    }

    /**
     * @dataProvider matchProvider
     */
    public function testMatches(string $pattern, string $url, bool $match)
    {
        $this->assertEquals($match, $this->parser->matches($url, $pattern));
    }

    /**
     * Provide array of positive match tests
     *
     * @return array
     */
    public function matchProvider()
    {
        return [
            ['', '', true],
            ['', '/', true],
            ['', '/welcome', false],
            ['welcome', '/welcome', true],
            ['welcome', '', false],
            ['/welcome', '/welcome', true],
            ['/welcome', '', false],
            ['users/edit/age', '/users/edit/age', true],
            ['users/edit/age', '/users/edit/name', false],
        ];
    }
}
