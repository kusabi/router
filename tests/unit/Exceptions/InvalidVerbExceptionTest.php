<?php

namespace Exceptions;

use Kusabi\Router\Exceptions\InvalidVerbException;

class InvalidVerbExceptionTest extends \Codeception\Test\Unit
{
    public function testMessageContainsTheVerb()
    {
        $exception = new InvalidVerbException('NOTREAL');
        $this->assertContains('NOTREAL', $exception->getMessage());
    }
}
