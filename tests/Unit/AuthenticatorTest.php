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
        $this->assertEquals('digest', $auth->type());
        $this->assertEquals('testRealm', $auth->realm());
        $this->assertEquals('testUser', $auth->username());
        $this->assertEquals('testPass', $auth->password());
    }

    public function testBasic(): void
    {
        $auth = Authenticator::basic('test');
        $this->assertInstanceOf(Authenticator::class, $auth);
        $this->assertEquals('basic', $auth->type());
        $this->assertEquals('test', $auth->realm());
    }

    public function testDigest(): void
    {
        $auth = Authenticator::digest('test');
        $this->assertInstanceOf(Authenticator::class, $auth);
        $this->assertEquals('digest', $auth->type());
        $this->assertEquals('test', $auth->realm());
    }

    public function testSetType(): void
    {
        $auth = Authenticator::basic()->setType('digest');
        $this->assertInstanceOf(Authenticator::class, $auth);
        $this->assertEquals('digest', $auth->type());
    }

    public function testSetRealm(): void
    {
        $auth = Authenticator::basic()->setRealm('foo');
        $this->assertInstanceOf(Authenticator::class, $auth);
        $this->assertEquals('foo', $auth->realm());
    }

    public function testSetUsername(): void
    {
        $auth = Authenticator::basic()->setUsername('foo');
        $this->assertInstanceOf(Authenticator::class, $auth);
        $this->assertEquals('foo', $auth->username());
    }

    public function testSetPassword(): void
    {
        $auth = Authenticator::basic()->setPassword('foo');
        $this->assertInstanceOf(Authenticator::class, $auth);
        $this->assertEquals('foo', $auth->password());
    }

    public function testSetCredentials(): void
    {
        $auth = Authenticator::basic()->setCredentials('foo', 'bar');
        $this->assertInstanceOf(Authenticator::class, $auth);
        $this->assertEquals('foo', $auth->username());
        $this->assertEquals('bar', $auth->password());
    }
}
