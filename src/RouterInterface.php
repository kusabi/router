<?php

namespace Kusabi\Router;

use Kusabi\Router\Exceptions\RouteNotFoundException;

/**
 * A router is a holder for an applications routes.
 *
 * It is responsible for the management of routes and figuring out which route should run.
 *
 * @author Christian Harvey <kusabi.software@gmail.com>
 */
interface RouterInterface
{
    /**
     * Get the routes in the router
     *
     * @return array
     */
    public function getRoutes(): array;

    /**
     * Add a route to the router
     *
     * @param string $method
     * @param string $pattern
     * @param mixed $action
     *
     * @return self
     */
    public function addRoute($method, $pattern, $action): self;

    /**
     * Add a GET route to the router
     *
     * @param $pattern
     * @param $action
     *
     * @return self
     */
    public function get($pattern, $action): self;

    /**
     * Add a POST route to the router
     *
     * @param $pattern
     * @param $action
     *
     * @return self
     */
    public function post($pattern, $action): self;

    /**
     * Add a PUT route to the router
     *
     * @param $pattern
     * @param $action
     *
     * @return self
     */
    public function put($pattern, $action): self;

    /**
     * Add a PATCH route to the router
     *
     * @param $pattern
     * @param $action
     *
     * @return self
     */
    public function patch($pattern, $action): self;

    /**
     * Add a DELETE route to the router
     *
     * @param $pattern
     * @param $action
     *
     * @return self
     */
    public function delete($pattern, $action): self;

    /**
     * Add an ANY route to the router
     *
     * @param $pattern
     * @param $action
     *
     * @return self
     */
    public function any($pattern, $action): self;

    /**
     * Run the router and return the results from the matching action
     *
     * @param string $verb
     * @param string $url
     *
     * @throws RouteNotFoundException when no match is found
     *
     * @return mixed
     */
    public function run(string $verb, string $url);
}
