<?php

namespace Kusabi\Router;

use Kusabi\Router\Routes\Route;

/**
 * A route factory is responsible for creating the routes.
 *
 * By replacing the default factory with a custom factory, the user is able to have their own route implementations created.
 *
 * @author Christian Harvey <christian.h@high-level-software.com>
 */
interface RouteFactoryInterface
{
    /**
     * Create a route implementation
     *
     * @param string $verb Default value is 'get'
     * @param string $pattern Default value is ''
     * @param ActionInterface|null $action Default value is defined in the implementation
     *
     * @return RouteInterface
     */
    public function createRoute(string $verb = Route::GET, string $pattern = '', ActionInterface $action = null): RouteInterface;
}
