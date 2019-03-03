<?php

namespace Kusabi\Router;

/**
 * A route must contain a http verb, a pattern and an action action.
 *
 * @author Christian Harvey <christian.h@high-level-software.com>
 */
interface RouteInterface
{
    /**
     * Get the HTTP verb
     *
     * @return string
     */
    public function getVerb(): string;

    /**
     * Get the pattern
     *
     * @return string
     */
    public function getPattern(): string;

    /**
     * Get the action
     *
     * @return ActionInterface
     */
    public function getAction(): ActionInterface;
}
