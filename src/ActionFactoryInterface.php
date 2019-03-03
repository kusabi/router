<?php

namespace Kusabi\Router;

/**
 * An action factory is responsible for creating an action instance based on the action data type
 *
 * @author Christian Harvey <christian.h@high-level-software.com>
 */
interface ActionFactoryInterface
{
    /**
     * Create an action for the action data type
     *
     * @param mixed $action
     *
     * @return ActionInterface
     */
    public function createAction($action): ActionInterface;
}
