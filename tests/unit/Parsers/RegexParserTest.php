<?php

namespace Parsers;

use Kusabi\Router\ParserInterface;
use Kusabi\Router\Parsers\RegexParser;

class RegexParserTest extends \Codeception\Test\Unit
{
    /**
     * @var RegexParser
     */
    protected $parser;

    protected function _before()
    {
        $this->parser = new RegexParser();
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
     *
     * @param string $pattern
     * @param string $url
     * @param bool $match
     * @param array $matches
     */
    public function testMatches(string $pattern, string $url, bool $match, array $matches = [])
    {
        $this->assertEquals($match, $this->parser->matches($url, $pattern));
        if ($match) {
            $this->assertEquals($matches, $this->parser->parse($url, $pattern));
        }
    }

    /**
     * Provide array of positive match tests
     *
     * @return array
     */
    public function matchProvider()
    {
        return [
            ['', '', true, []],
            ['', '/', true, []],
            ['(.*)', 'welcome', true, ['welcome']],
            ['(.*)', 'welcome/to/my/site', true, ['welcome/to/my/site']],
            ['(.*)\/(.*)', 'welcome/to/my/site/', true, ['welcome/to/my/site', '']],
            ['(.*?)\/(.*?)\/(.*?)\/(.*?)\/', 'welcome/to/my/site/', true, ['welcome', 'to', 'my', 'site']],
            ['(.*?)\/(.*?)\/(.*?)\/(.*)', 'welcome/to/my/site', true, ['welcome', 'to', 'my', 'site']],
            ['users\/(\d+)\/edit', 'users/21/edit', true, ['21']],
            ['users\/([^\d]+)\/edit', 'lol/users/21/edit', false],
            ['users\/([^\d]+)\/edit', 'users/word/edit', true, ['word']],
            ['users\/([^\d]+)\/edit', 'fred/users/word/edit', true, ['word']],
            ['^users\/([^\d]+)\/edit', 'fred/users/word/edit', false, ],
        ];
    }
}
