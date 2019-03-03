<?php

namespace Kusabi\Router\Factories;

use Kusabi\Router\ActionInterface;
use Kusabi\Router\RouteFactoryInterface;
use Kusabi\Router\RouteInterface;
use Kusabi\Router\Routes\Route;

/**
 * The standard route factory class defined by this library
 *
 * @author Christian Harvey <christian.h@high-level-software.com>
 */
class RouteFactory implements RouteFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createRoute(string $verb = Route::GET, string $pattern = '', ActionInterface $action = null): RouteInterface
    {
        return new Route($verb, $pattern, $action);
    }
}
