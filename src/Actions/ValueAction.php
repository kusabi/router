<?php

namespace Kusabi\Router\Actions;

use Kusabi\Router\ActionInterface;

/**
 * A value action simply returns a single value.
 *
 * @author Christian Harvey <christian.h@high-level-software.com>
 */
class ValueAction implements ActionInterface
{
    /**
     * The value to return
     *
     * @var mixed
     */
    protected $value;

    /**
     * ValueAction constructor.
     *
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Get the value of this action
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value of the action
     *
     * @param mixed $value
     *
     * @return self
     */
    public function setValue($value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function run(...$params)
    {
        return $this->value;
    }
}
