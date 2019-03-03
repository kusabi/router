<?php

namespace Kusabi\Router\Actions;

use Kusabi\Router\ActionInterface;

/**
 * A lambda action will return the results of a lambda method when dispatched.
 *
 * It will pass the parameters passed to `run()` through to the lambda method
 *
 * @author Christian Harvey <christian.h@high-level-software.com>
 */
class LambdaAction implements ActionInterface
{
    /**
     * The lambda method to invoke
     *
     * @var callable
     */
    protected $lambda;

    /**
     * LambdaAction constructor.
     *
     * @param callable $lambda
     */
    public function __construct(callable $lambda)
    {
        $this->lambda = $lambda;
    }

    /**
     * {@inheritdoc}
     */
    public function run(...$params)
    {
        return call_user_func_array($this->lambda, $params);
    }
}
