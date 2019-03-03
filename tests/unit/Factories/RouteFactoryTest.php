<?php

namespace Factories;

use Kusabi\Router\Actions\NullAction;
use Kusabi\Router\Actions\ValueAction;
use Kusabi\Router\Factories\RouteFactory;
use Kusabi\Router\RouteFactoryInterface;
use Kusabi\Router\Routes\Route;

class RouteFactoryTest extends \Codeception\Test\Unit
{
    public function testInstanceOfRouteFactoryInterface()
    {
        $this->assertInstanceOf(RouteFactoryInterface::class, new RouteFactory());
    }

    public function testCreatesRouteImplementation()
    {
        $routeFactory = new RouteFactory();
        $route = $routeFactory->createRoute(Route::GET, 'test', new NullAction());
        $this->assertInstanceOf(Route::class, $route);
    }

    public function testDefaultVerbIsGET()
    {
        $routeFactory = new RouteFactory();
        $route = $routeFactory->createRoute();
        $this->assertSame(Route::GET, $route->getVerb());
    }

    public function testDefaultPatternIsEmptyString()
    {
        $routeFactory = new RouteFactory();
        $route = $routeFactory->createRoute();
        $this->assertSame('', $route->getPattern());
    }

    public function testDefaultActionIsNullAction()
    {
        $routeFactory = new RouteFactory();
        $route = $routeFactory->createRoute();
        $this->assertInstanceOf(NullAction::class, $route->getAction());
    }

    public function testCanSetVerbInConstructor()
    {
        $routeFactory = new RouteFactory();
        $route = $routeFactory->createRoute(Route::POST);
        $this->assertSame(Route::POST, $route->getVerb());
    }

    public function testCanSetPatternInConstructor()
    {
        $routeFactory = new RouteFactory();
        $route = $routeFactory->createRoute(Route::GET, 'test');
        $this->assertSame('test', $route->getPattern());
    }

    public function testCanSetActionInConstructor()
    {
        $routeFactory = new RouteFactory();
        $route = $routeFactory->createRoute(Route::GET, 'test', new ValueAction(1));
        $this->assertInstanceOf(ValueAction::class, $route->getAction());
    }
}
