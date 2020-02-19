<?php

namespace Intervention\Httpauth\Test;

use Intervention\Httpauth\Token\TokenInterface;
use Intervention\Httpauth\Token\NullAuth;
use Intervention\Httpauth\Environment;
use PHPUnit\Framework\TestCase;

class EnvironmentTest extends TestCase
{
    public function testGetAuth()
    {
        $environment = new Environment;
        $auth = $environment->getToken();
        $this->assertInstanceOf(TokenInterface::class, $auth);
    }
}
