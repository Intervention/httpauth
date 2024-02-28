<?php

namespace Intervention\HttpAuth\Test\Unit;

use Intervention\HttpAuth\Environment;
use PHPUnit\Framework\TestCase;
use Intervention\HttpAuth\Key;

final class EnvironmentTest extends TestCase
{
    public function testGetKey(): void
    {
        $_SERVER['PHP_AUTH_USER'] = 'user';
        $_SERVER['PHP_AUTH_PW'] = 'pass';

        $environment = new Environment();
        $key = $environment->getKey();
        $this->assertInstanceOf(Key::class, $key);
    }
}
