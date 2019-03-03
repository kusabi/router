<?php

namespace Actions;

use Kusabi\Router\ActionInterface;
use Kusabi\Router\Actions\LambdaAction;

class LambdaActionTest extends \Codeception\Test\Unit
{
    public function testInstanceOfActionInterface()
    {
        $this->assertInstanceOf(ActionInterface::class, new LambdaAction(function () {
            return 'success';
        }));
    }

    public function testReturnsResultOfLambda()
    {
        $action = new LambdaAction(function () {
            return 'success';
        });
        $this->assertEquals('success', $action->run());
    }

    public function testParametersAreAvailableToLambda()
    {
        $dispatcher = new LambdaAction(function ($a, $b, $c, $d) {
            return implode(',', [$a, $b, $c, $d]);
        });
        $this->assertEquals('a,b,c,d', $dispatcher->run('a', 'b', 'c', 'd'));
    }

    /**
     * @expectedException \TypeError
     */
    public function testParametersCanBeTypeCast()
    {
        $dispatcher = new LambdaAction(function (string $a, int $b, bool $c, callable $d) {
            return implode(',', [$a, $b, $c, $d]);
        });
        $this->assertEquals('a,b,c,d', $dispatcher->run('a', 'b', 'c', 'd'));
    }

    public function testUseParametersAreAvailableToLambda()
    {
        $name = 'John Doe';
        $dispatcher = new LambdaAction(function (int $age) use ($name) {
            return "{$name} is {$age} years old";
        });
        $this->assertEquals('John Doe is 100 years old', $dispatcher->run(100));
    }
}
