<?php

namespace Exceptions;

use Kusabi\Router\Exceptions\MatchNotFoundException;

class MatchNotFoundExceptionTest extends \Codeception\Test\Unit
{
    public function testMessageContainsTheUrl()
    {
        $exception = new MatchNotFoundException('users/21.5', 'users/{:int}');
        $this->assertContains('users/21.5', $exception->getMessage());
    }

    public function testMessageContainsThePattern()
    {
        $exception = new MatchNotFoundException('users/21.5', 'users/{:int}');
        $this->assertContains('users/{:int}', $exception->getMessage());
    }
}
