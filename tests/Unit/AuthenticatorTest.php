<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Tests\Unit;

use Intervention\HttpAuth\Authenticator;
use PHPUnit\Framework\TestCase;

final class AuthenticatorTest extends TestCase
{
    public function testMake(): void
    {
        $auth = Authenticator::make([
            'type' => 'digest',
            'realm' => 'testRealm',
            'username' => 'testUser',
            'password' => 'testPass',
        ]);

        $this->assertInstanceOf(Authenticator::class, $auth);
        $this->assertEquals('digest', $auth->getType());
        $this->assertEquals('testRealm', $auth->getRealm());
        $this->assertEquals('testUser', $auth->getUsername());
        $this->assertEquals('testPass', $auth->getPassword());
    }

    public function testBasic(): void
    {
        $auth = Authenticator::basic('test');
        $this->assertInstanceOf(Authenticator::class, $auth);
        $this->assertEquals('basic', $auth->getType());
        $this->assertEquals('test', $auth->getRealm());
    }

    public function testDigest(): void
    {
        $auth = Authenticator::digest('test');
        $this->assertInstanceOf(Authenticator::class, $auth);
        $this->assertEquals('digest', $auth->getType());
        $this->assertEquals('test', $auth->getRealm());
    }

    public function testSetType(): void
    {
        $auth = Authenticator::basic()->setType('digest');
        $this->assertInstanceOf(Authenticator::class, $auth);
        $this->assertEquals('digest', $auth->getType());
    }

    public function testSetRealm(): void
    {
        $auth = Authenticator::basic()->setRealm('foo');
        $this->assertInstanceOf(Authenticator::class, $auth);
        $this->assertEquals('foo', $auth->getRealm());
    }

    public function testSetUsername(): void
    {
        $auth = Authenticator::basic()->setUsername('foo');
        $this->assertInstanceOf(Authenticator::class, $auth);
        $this->assertEquals('foo', $auth->getUsername());
    }

    public function testSetPassword(): void
    {
        $auth = Authenticator::basic()->setPassword('foo');
        $this->assertInstanceOf(Authenticator::class, $auth);
        $this->assertEquals('foo', $auth->getPassword());
    }

    public function testSetCredentials(): void
    {
        $auth = Authenticator::basic()->setCredentials('foo', 'bar');
        $this->assertInstanceOf(Authenticator::class, $auth);
        $this->assertEquals('foo', $auth->getUsername());
        $this->assertEquals('bar', $auth->getPassword());
    }
}
