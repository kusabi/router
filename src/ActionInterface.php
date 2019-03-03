<?php

namespace Kusabi\Router;

/**
 * An action is responsible for returning a result to the router.
 *
 * The value it returns is entirely dependant on the type of action, the action data and any extra parameters the router chooses to pass to the `run()` method.
 *
 * @author Christian Harvey <christian.h@high-level-software.com>
 */
interface ActionInterface
{
    /**
     * Run the action
     *
     * @param mixed ...$params
     *
     * @return mixed
     */
    public function run(...$params);
}
