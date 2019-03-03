<?php

namespace Kusabi\Router\Routers;

use Kusabi\Router\ActionFactoryAwareInterface;
use Kusabi\Router\ActionFactoryAwareTrait;
use Kusabi\Router\Exceptions\RouteNotFoundException;
use Kusabi\Router\Factories\ActionFactory;
use Kusabi\Router\Factories\RouteFactory;
use Kusabi\Router\ParserAwareInterface;
use Kusabi\Router\ParserAwareTrait;
use Kusabi\Router\Parsers\FriendlyParser;
use Kusabi\Router\RouteFactoryAwareInterface;
use Kusabi\Router\RouteFactoryAwareTrait;
use Kusabi\Router\RouteInterface;
use Kusabi\Router\RouterInterface;
use Kusabi\Router\Routes\Route;

/**
 * An implementation of a router using arrays
 *
 * This is the default router for this library
 *
 * @author Christian Harvey <kusabi.software@gmail.com>
 */
class Router implements RouterInterface, ParserAwareInterface, ActionFactoryAwareInterface, RouteFactoryAwareInterface
{
    use ParserAwareTrait, ActionFactoryAwareTrait, RouteFactoryAwareTrait;

    /**
     * Routes loaded into the router
     *
     * @var array
     */
    protected $routes = [];

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->setParser(new FriendlyParser());
        $this->setActionFactory(new ActionFactory());
        $this->setRouteFactory(new RouteFactory());
    }

    /**
     * {@inheritdoc}
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * {@inheritdoc}
     *
     * @return self
     */
    public function addRoute($method, $pattern, $action): RouterInterface
    {
        $this->routes[] = $this->getRouteFactory()->createRoute(
            $method,
            $pattern,
            $this->getActionFactory()->createAction($action)
        );
        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return self
     *
     * @see Router::route()
     */
    public function get($pattern, $action): RouterInterface
    {
        return $this->addRoute(Route::GET, $pattern, $action);
    }

    /**
     * {@inheritdoc}
     *
     * @return self
     *
     * @see Router::route()
     */
    public function post($pattern, $action): RouterInterface
    {
        return $this->addRoute(Route::POST, $pattern, $action);
    }

    /**
     * {@inheritdoc}
     *
     * @return self
     *
     * @see Router::route()
     */
    public function put($pattern, $action): RouterInterface
    {
        return $this->addRoute(Route::PUT, $pattern, $action);
    }

    /**
     * {@inheritdoc}
     *
     * @return self
     *
     * @see Router::route()
     */
    public function patch($pattern, $action): RouterInterface
    {
        return $this->addRoute(Route::PATCH, $pattern, $action);
    }

    /**
     * {@inheritdoc}
     *
     * @return self
     *
     * @see Router::route()
     */
    public function delete($pattern, $action): RouterInterface
    {
        return $this->addRoute(Route::DELETE, $pattern, $action);
    }

    /**
     * {@inheritdoc}
     *
     * @return self
     *
     * @see Router::route()
     */
    public function any($pattern, $action): RouterInterface
    {
        return $this->addRoute(Route::ANY, $pattern, $action);
    }

    /**
     * {@inheritdoc}
     */
    public function run(string $verb, string $url)
    {
        // Lowercase the verb
        $verb = strtolower($verb);

        foreach ($this->routes as $route) {
            if (!$route instanceof RouteInterface) {
                continue;
            }
            if ($route->getVerb() === 'any' || $route->getVerb() === $verb) {
                if ($this->getParser()->matches($url, $route->getPattern())) {
                    return $route->getAction()->run(
                        ...$this->getParser()->parse($url, $route->getPattern())
                    );
                }
            }
        }

        // No route found
        throw new RouteNotFoundException();
    }
}
