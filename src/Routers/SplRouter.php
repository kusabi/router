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
use SplFixedArray;

/**
 * The SplRouter uses an `SplFixedArray` to hold it's routes.
 *
 * This is a special use implementation for those who have loads of routes and need the speed.
 *
 * The pros of using an `SplFixedArray` is they are quicker with larger data sets than native arrays.
 *
 * The cons of using an `SplFixedArray` is that you need to know the sie of the array ahead of time and the indices can only be integers
 *
 * @author Christian Harvey <kusabi.software@gmail.com>
 */
class SplRouter implements RouterInterface, ParserAwareInterface, ActionFactoryAwareInterface, RouteFactoryAwareInterface
{
    use ParserAwareTrait, ActionFactoryAwareTrait, RouteFactoryAwareTrait;

    /**
     * The count to insert new routes at
     *
     * @var int
     */
    protected $count = 0;

    /**
     * Routes loaded into the router
     *
     * @var SplFixedArray
     */
    protected $routes = null;

    /**
     * SplRouter constructor.
     *
     * @param int $size
     */
    public function __construct(int $size)
    {
        $this->routes = new SplFixedArray($size);
        $this->setParser(new FriendlyParser());
        $this->setActionFactory(new ActionFactory());
        $this->setRouteFactory(new RouteFactory());
    }

    /**
     * {@inheritdoc}
     */
    public function getRoutes(): array
    {
        return $this->routes->toArray();
    }

    /**
     * {@inheritdoc}
     *
     * @return self
     */
    public function addRoute($method, $pattern, $action): RouterInterface
    {
        $this->routes[$this->count++] = $this->getRouteFactory()->createRoute(
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

        /** @var RouteInterface $route */
        foreach ($this->getRoutes() as $route) {
            if (!$route || !$route instanceof RouteInterface) {
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
