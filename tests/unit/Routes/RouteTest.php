<?php

namespace Routes;

use Kusabi\Router\Actions\NullAction;
use Kusabi\Router\Actions\ValueAction;
use Kusabi\Router\Routes\Route;

class RouteTest extends \Codeception\Test\Unit
{
    public function testInstanceOfRoute()
    {
        $this->assertInstanceOf(Route::class, new Route('get', '', new NullAction()));
    }

    public function testDefaultVerbIsGET()
    {
        $route = new Route();
        $this->assertSame(Route::GET, $route->getVerb());
    }

    public function testDefaultPatternIsEmptyString()
    {
        $route = new Route();
        $this->assertSame('', $route->getPattern());
    }

    public function testDefaultActionIsNullAction()
    {
        $route = new Route();
        $this->assertInstanceOf(NullAction::class, $route->getAction());
    }

    public function testCanSetVerbInConstructor()
    {
        $route = new Route(Route::POST);
        $this->assertSame(Route::POST, $route->getVerb());
    }

    public function testCanSetPatternInConstructor()
    {
        $route = new Route(Route::GET, 'test');
        $this->assertSame('test', $route->getPattern());
    }

    public function testCanSetActionInConstructor()
    {
        $route = new Route(Route::GET, 'test', new ValueAction(1));
        $this->assertInstanceOf(ValueAction::class, $route->getAction());
    }

    public function testCanChangeVerb()
    {
        $route = new Route();
        $this->assertEquals(Route::POST, $route->setVerb(Route::POST)->getVerb());
    }

    public function testCanChangePattern()
    {
        $route = new Route();
        $this->assertEquals('test', $route->setPattern('test')->getPattern());
    }

    public function testCanChangeAction()
    {
        $route = new Route();
        $this->assertInstanceOf(ValueAction::class, $route->setAction(new ValueAction('test'))->getAction());
    }

    /**
     * @expectedException \Kusabi\Router\Exceptions\InvalidVerbException
     */
    public function testThrowsInvalidVerbExecption()
    {
        $route = new Route();
        $route->setVerb('invalid');
    }
}
