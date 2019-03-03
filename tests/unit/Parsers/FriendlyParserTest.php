<?php

namespace Parsers;

use Kusabi\Router\ParserInterface;
use Kusabi\Router\Parsers\FriendlyParser;

class FriendlyParserTest extends \Codeception\Test\Unit
{
    /**
     * @var FriendlyParser
     */
    protected $parser;

    protected function _before()
    {
        $this->parser = new FriendlyParser();
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

    public function testStressOneThousand()
    {
        $uri = 'users/1/set-height/5.11/set-name/john doe';
        $pattern = 'users/{:int}/set-height/{:float}/set-name/([\w ]+)';
        $match = [1, 5.11, 'john doe'];
        for ($i = 0; $i < 1000; $i++) {
            if ($this->parser->matches($uri, $pattern)) {
                $this->assertEquals($match, $this->parser->parse($uri, $pattern));
            }
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
            ['test/route/with/base/slash', '/test/route/with/base/slash', true, []],
            ['{path}', 'welcome', true, ['welcome']],
            ['{path}', 'welcome/to/my/site', false],
            ['{path}/{path}/{path}/{path}', 'welcome/to/my/site', true, ['welcome', 'to', 'my', 'site']],
            ['users/{userId}/edit', 'users/1/edit', true, ['1']],
            ['users/{userId}/edit', 'users/999/edit', true, ['999']],
            ['users/{userId}/addresses/{addressId}/windows/{windowId}/delete', 'users/999/addresses/3/windows/2/delete', true, [999, 3, 2]],
            ['users/{:any}', 'users/999/addresses/3/windows/2/delete', true, ['999/addresses/3/windows/2/delete']],
            ['{:any}/{:any}', 'users/999/addresses/3/windows/2/delete', true, ['users/999/addresses/3/windows/2', 'delete']],
            ['users/{:int}', 'users/999', true, [999]],
            ['users/{:int}', 'users/peter', false],
            ['users/{:int}', 'users/99.5', false],
            ['users/{:float}', 'users/999', true, [999]],
            ['users/{:float}', 'users/999.9', true, [999.9]],
            ['users/{:int}', 'users/peter', false],
            ['users/{:alpha}', 'users/peter', true, ['peter']],
            ['users/{:alpha}', 'users/1', false],
            ['users/{:int}/set-height/{:float}/set-name/{:alpha}', 'users/1/set-height/5.11/set-name/john', true, [1, 5.11, 'john']],
            ['users/{:int}/set-height/{:float}/set-name/{:nothing}', 'users/1/set-height/5.11/set-name/john doe', false],
            ['users/{:int}/set-height/{:float}/set-name/([\w ]+)', 'users/1/set-height/5.11/set-name/john doe', true, [1, 5.11, 'john doe']],
        ];
    }
}
