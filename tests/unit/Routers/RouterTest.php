<?php

namespace Routers;

use Kusabi\Router\Actions\NullAction;
use Kusabi\Router\Routers\Router;
use Kusabi\Router\Routes\Route;

class RouterTest extends \Codeception\Test\Unit
{
    /**
     * The level of stress to perform in the stress test
     *
     * @var int
     */
    const STRESS_AMOUNT = 1000;

    public function testAddRoute()
    {
        $router = new Router();
        foreach (Route::VERBS as $verb) {
            $router->addRoute($verb, 'test', new NullAction());
        }
        $this->assertCount(count(Route::VERBS), $router->getRoutes());
    }

    public function testAddBasicGetRoute()
    {
        $router = new Router();
        $router->get('test', new NullAction());
        $this->assertCount(1, $router->getRoutes());
    }

    public function testAddBasicPostRoute()
    {
        $router = new Router();
        $router->post('test', new NullAction());
        $this->assertCount(1, $router->getRoutes());
    }

    public function testAddBasicPutRoute()
    {
        $router = new Router();
        $router->put('test', new NullAction());
        $this->assertCount(1, $router->getRoutes());
    }

    public function testAddBasicPatchRoute()
    {
        $router = new Router();
        $router->patch('test', new NullAction());
        $this->assertCount(1, $router->getRoutes());
    }

    public function testAddBasicDeleteRoute()
    {
        $router = new Router();
        $router->delete('test', new NullAction());
        $this->assertCount(1, $router->getRoutes());
    }

    public function testAddBasicAnyRoute()
    {
        $router = new Router();
        $router->any('test', new NullAction());
        $this->assertCount(1, $router->getRoutes());
    }

    public function testMatchRoutes()
    {
        $router = new Router();
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
        $router = new Router();
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
        $router = new Router();
        $router->run('get', 'test');
    }
}
