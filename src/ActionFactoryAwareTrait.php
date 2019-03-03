<?php

namespace Kusabi\Router;

/**
 * An action factory aware object can set a retrieve an action factory implementation
 *
 * @author Christian Harvey <christian.h@high-level-software.com>
 */
trait ActionFactoryAwareTrait
{
    /**
     * The action factory implementation held by this object
     *
     * @var ActionFactoryInterface
     */
    protected $actionFactory;

    /**
     * Get the action factory implementation
     *
     * @return ActionFactoryInterface|null
     */
    public function getActionFactory(): ?ActionFactoryInterface
    {
        return $this->actionFactory;
    }

    /**
     * Set the action factory implementation
     *
     * @param ActionFactoryInterface $actionFactory
     *
     * @return void
     */
    public function setActionFactory(ActionFactoryInterface $actionFactory): void
    {
        $this->actionFactory = $actionFactory;
    }
}
