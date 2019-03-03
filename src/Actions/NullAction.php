<?php

namespace Kusabi\Router\Actions;

use Kusabi\Router\ActionInterface;

/**
 * A null action is used for some unit tests where we do not care what happens when a route is matched
 *
 * @author Christian Harvey <christian.h@high-level-software.com>
 */
class NullAction implements ActionInterface
{
    /**
     * {@inheritdoc}
     */
    public function run(...$params)
    {
        return null;
    }
}
