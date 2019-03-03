<?php

namespace Actions;

use Kusabi\Router\ActionInterface;
use Kusabi\Router\Actions\ValueAction;

class ValueActionTest extends \Codeception\Test\Unit
{
    public function testInstanceOfActionInterface()
    {
        $this->assertInstanceOf(ActionInterface::class, new ValueAction('success'));
    }

    /**
     * @dataProvider provideValues()
     *
     * @param mixed $value
     */
    public function testReturnsValue($value)
    {
        $action = new ValueAction($value);
        $this->assertSame($value, $action->run());
    }

    public function testCanChangeValue()
    {
        $action = new ValueAction('default');
        $this->assertSame('success', $action->setValue('success')->getValue());
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
            'function' => [function () {
                return 'LOL';
            }]
        ];
    }
}
