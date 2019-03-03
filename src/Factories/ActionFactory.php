<?php

namespace Kusabi\Router\Factories;

use Kusabi\Router\ActionFactoryInterface;
use Kusabi\Router\ActionInterface;
use Kusabi\Router\Actions\LambdaAction;
use Kusabi\Router\Actions\ValueAction;

/**
 * A action factory is responsible for creating a action instance based on the action data type
 *
 * @author Christian Harvey <christian.h@high-level-software.com>
 */
class ActionFactory implements ActionFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createAction($action): ActionInterface
    {
        // Lambda action?
        if (is_callable($action)) {
            return $this->createLambdaAction($action);
        }

        // Fallback to the value action
        return $this->createValueAction($action);
    }

    /**
     * Create a lambda action
     *
     * @param callable $action
     *
     * @return LambdaAction
     */
    protected function createLambdaAction(callable $action): LambdaAction
    {
        return new LambdaAction($action);
    }

    /**
     * Create a value action
     *
     * @param mixed $action
     *
     * @return ValueAction
     */
    protected function createValueAction($action): ValueAction
    {
        return new ValueAction($action);
    }
}
