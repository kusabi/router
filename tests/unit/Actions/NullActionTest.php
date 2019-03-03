<?php

namespace Actions;

use Kusabi\Router\ActionInterface;
use Kusabi\Router\Actions\NullAction;

class NullActionTest extends \Codeception\Test\Unit
{
    public function testInstanceOfActionInterface()
    {
        $this->assertInstanceOf(ActionInterface::class, new NullAction());
    }

    public function testReturnsNull()
    {
        $this->assertNull((new NullAction())->run());
    }
}
