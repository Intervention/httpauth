<?php

namespace Intervention\HttpAuth\Test;

use Intervention\HttpAuth\Authenticator;
use PHPUnit\Framework\TestCase;

class AuthenticatorTest extends TestCase
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

    public function testBasic()
    {
        $auth = Authenticator::basic('test');
        $this->assertInstanceOf(Authenticator::class, $auth);
        $this->assertEquals('basic', $auth->getType());
        $this->assertEquals('test', $auth->getRealm());
    }

    public function testWithDigest()
    {
        $auth = Authenticator::digest('test');
        $this->assertInstanceOf(Authenticator::class, $auth);
        $this->assertEquals('digest', $auth->getType());
        $this->assertEquals('test', $auth->getRealm());
    }

    public function testWithType()
    {
        $auth = Authenticator::basic()->withType('digest');
        $this->assertInstanceOf(Authenticator::class, $auth);
        $this->assertEquals('digest', $auth->getType());
    }

    public function testWithRealm()
    {
        $auth = Authenticator::basic()->withRealm('foo');
        $this->assertInstanceOf(Authenticator::class, $auth);
        $this->assertEquals('foo', $auth->getRealm());
    }

    public function testWithUsername()
    {
        $auth = Authenticator::basic()->withUsername('foo');
        $this->assertInstanceOf(Authenticator::class, $auth);
        $this->assertEquals('foo', $auth->getUsername());
    }

    public function testWithPassword()
    {
        $auth = Authenticator::basic()->withPassword('foo');
        $this->assertInstanceOf(Authenticator::class, $auth);
        $this->assertEquals('foo', $auth->getPassword());
    }

    public function testWithCredentials()
    {
        $auth = Authenticator::basic()->withCredentials('foo', 'bar');
        $this->assertInstanceOf(Authenticator::class, $auth);
        $this->assertEquals('foo', $auth->getUsername());
        $this->assertEquals('bar', $auth->getPassword());
    }
}