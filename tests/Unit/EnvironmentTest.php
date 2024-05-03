<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Tests\Unit;

use Intervention\HttpAuth\Environment;
use Intervention\HttpAuth\Interfaces\TokenInterface;
use PHPUnit\Framework\TestCase;

final class EnvironmentTest extends TestCase
{
    public function testToken(): void
    {
        $_SERVER['PHP_AUTH_USER'] = 'user';
        $_SERVER['PHP_AUTH_PW'] = 'pass';

        $this->assertInstanceOf(TokenInterface::class, Environment::token());
    }
}
