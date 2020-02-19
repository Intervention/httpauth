<?php

namespace Intervention\HttpAuth\Test;

use Intervention\HttpAuth\TokenInterface;
use Intervention\HttpAuth\Token\NullAuth;
use Intervention\HttpAuth\Environment;
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
