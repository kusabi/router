<?php

namespace Kusabi\Router;

/**
 * A route factory aware object can set a retrieve a route factory implementation
 *
 * @author Christian Harvey <christian.h@high-level-software.com>
 */
interface RouteFactoryAwareInterface
{
    /**
     * Get the route factory implementation
     *
     * @return RouteFactoryInterface|null
     */
    public function getRouteFactory(): ?RouteFactoryInterface;

    /**
     * Set the route factory implementation
     *
     * @param RouteFactoryInterface $routeFactory
     *
     * @return void
     */
    public function setRouteFactory(RouteFactoryInterface $routeFactory): void;
}
