<?php

namespace Kusabi\Router;

/**
 * A route factory aware object can set a retrieve a route factory implementation
 *
 * @author Christian Harvey <christian.h@high-level-software.com>
 */
trait RouteFactoryAwareTrait
{
    /**
     * The route factory implementation held by this object
     *
     * @var RouteFactoryInterface
     */
    protected $routeFactory;

    /**
     * Get the route factory implementation
     *
     * @return RouteFactoryInterface|null
     */
    public function getRouteFactory(): ?RouteFactoryInterface
    {
        return $this->routeFactory;
    }

    /**
     * Set the route factory implementation
     *
     * @param RouteFactoryInterface $routeFactory
     *
     * @return void
     */
    public function setRouteFactory(RouteFactoryInterface $routeFactory): void
    {
        $this->routeFactory = $routeFactory;
    }
}
