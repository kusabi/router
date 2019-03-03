<?php

namespace Factories;

use Kusabi\Router\ActionFactoryInterface;
use Kusabi\Router\Actions\LambdaAction;
use Kusabi\Router\Actions\ValueAction;
use Kusabi\Router\Factories\ActionFactory;

class ActionFactoryTest extends \Codeception\Test\Unit
{
    public function testInstanceOfActionFactoryInterface()
    {
        $this->assertInstanceOf(ActionFactoryInterface::class, new ActionFactory());
    }

    /**
     * @dataProvider provideValues()
     *
     * @param mixed $value
     */
    public function testLambdaValueReturnsLambdaAction($value)
    {
        $actionFactory = new ActionFactory();
        $action = $actionFactory->createAction(function () use ($value) {
            return $value;
        });
        $this->assertInstanceOf(LambdaAction::class, $action);
        $this->assertSame($value, $action->run());
    }

    /**
     * @dataProvider provideValues()
     *
     * @param mixed $value
     */
    public function testCreatesValueActionForValues($value)
    {
        $actionFactory = new ActionFactory();
        $action = $actionFactory->createAction($value);
        $this->assertInstanceOf(ValueAction::class, $action);
        $this->assertSame($value, $action->run());
    }

    public function provideValues()
    {
        return [
            'int' => [3],
            'float' => [3.14],
            'bool (true)' => [true],
            'bool (false)' => [false],
            'string' => ['success'],
            'array' => [1, 2, 3],
        ];
    }
}
