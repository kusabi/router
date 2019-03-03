<?php

namespace Routers;

use Kusabi\Router\Actions\NullAction;
use Kusabi\Router\Routers\SplRouter;
use Kusabi\Router\Routes\Route;

class SplRouterTest extends \Codeception\Test\Unit
{
    /**
     * The level of stress to perform in the stress test
     *
     * @var int
     */
    const STRESS_AMOUNT = 1000;

    public function testAddRoute()
    {
        $router = new SplRouter(6);
        foreach (Route::VERBS as $verb) {
            $router->addRoute($verb, 'test', new NullAction());
        }
        $this->assertCount(count(Route::VERBS), $router->getRoutes());
    }

    public function testAddBasicGetRoute()
    {
        $router = new SplRouter(1);
        $router->get('test', new NullAction());
        $this->assertCount(1, $router->getRoutes());
    }

    public function testAddBasicPostRoute()
    {
        $router = new SplRouter(1);
        $router->post('test', new NullAction());
        $this->assertCount(1, $router->getRoutes());
    }

    public function testAddBasicPutRoute()
    {
        $router = new SplRouter(1);
        $router->put('test', new NullAction());
        $this->assertCount(1, $router->getRoutes());
    }

    public function testAddBasicPatchRoute()
    {
        $router = new SplRouter(1);
        $router->patch('test', new NullAction());
        $this->assertCount(1, $router->getRoutes());
    }

    public function testAddBasicDeleteRoute()
    {
        $router = new SplRouter(1);
        $router->delete('test', new NullAction());
        $this->assertCount(1, $router->getRoutes());
    }

    public function testAddBasicAnyRoute()
    {
        $router = new SplRouter(1);
        $router->any('test', new NullAction());
        $this->assertCount(1, $router->getRoutes());
    }

    public function testMatchRoutes()
    {
        $router = new SplRouter(30);
        foreach (['users', 'accounts', 'images', 'comments', 'likes'] as $section) {
            foreach (Route::VERBS as $verb) {
                $router->addRoute($verb, "{$section}/{id}", function (int $id) use ($section, $verb) {
                    return "{$section} {$verb} {$id}";
                });
                $this->assertEquals("{$section} {$verb} 21", $router->run($verb, "{$section}/21"));
            }
        }
    }

    public function testMatchRoutesUnderStress()
    {
        $router = new SplRouter(self::STRESS_AMOUNT * 6);
        for ($i = 1; $i <= self::STRESS_AMOUNT; $i++) {
            foreach (Route::VERBS as $verb) {
                $router->addRoute($verb, "{$i}/{id}", function (int $id) use ($i, $verb) {
                    return "{$i} {$verb} {$id}";
                });
            }
        }
        $this->assertEquals('1 get 21', $router->run(Route::GET, '1/21'));
    }

    /**
     * @expectedException \Kusabi\Router\Exceptions\RouteNotFoundException
     */
    public function testRouteNotFoundThrowsException()
    {
        $router = new SplRouter(1);
        $router->run('get', 'test');
    }
}
