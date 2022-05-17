<?php

namespace Intervention\HttpAuth\Test;

use Intervention\HttpAuth\Environment;
use PHPUnit\Framework\TestCase;
use Intervention\HttpAuth\Key;

class EnvironmentTest extends TestCase
{
    public function testGetKey()
    {
        $_SERVER['PHP_AUTH_USER'] = 'user';
        $_SERVER['PHP_AUTH_PW'] = 'pass';

        $environment = new Environment();
        $key = $environment->getKey();
        $this->assertInstanceOf(Key::class, $key);
    }
}
