<?php

namespace Kusabi\Router;

/**
 * An action factory aware object can set a retrieve an action factory implementation
 *
 * @author Christian Harvey <christian.h@high-level-software.com>
 */
interface ActionFactoryAwareInterface
{
    /**
     * Get the action factory implementation
     *
     * @return ActionFactoryInterface|null
     */
    public function getActionFactory(): ?ActionFactoryInterface;

    /**
     * Set the action factory implementation
     *
     * @param ActionFactoryInterface $actionFactory
     *
     * @return void
     */
    public function setActionFactory(ActionFactoryInterface $actionFactory): void;
}
