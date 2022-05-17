<?php

namespace Intervention\HttpAuth\Test;

use Intervention\HttpAuth\HttpAuth as Auth;
use PHPUnit\Framework\TestCase;

class HttpAuthTest extends TestCase
{
    public function testMake(): void
    {
        $auth = Auth::make([
            'type' => 'digest',
            'realm' => 'testRealm',
            'username' => 'testUser',
            'password' => 'testPass',
        ]);

        $this->assertInstanceOf(Auth::class, $auth);
        $this->assertEquals('digest', $auth->getType());
        $this->assertEquals('testRealm', $auth->getRealm());
        $this->assertEquals('testUser', $auth->getUsername());
        $this->assertEquals('testPass', $auth->getPassword());
    }

    public function testBasic()
    {
        $auth = Auth::basic('test');
        $this->assertInstanceOf(Auth::class, $auth);
        $this->assertEquals('basic', $auth->getType());
        $this->assertEquals('test', $auth->getRealm());
    }

    public function testWithDigest()
    {
        $auth = Auth::digest('test');
        $this->assertInstanceOf(Auth::class, $auth);
        $this->assertEquals('digest', $auth->getType());
        $this->assertEquals('test', $auth->getRealm());
    }

    public function testWithType()
    {
        $auth = Auth::basic()->withType('digest');
        $this->assertInstanceOf(Auth::class, $auth);
        $this->assertEquals('digest', $auth->getType());
    }

    public function testWithRealm()
    {
        $auth = Auth::basic()->withRealm('foo');
        $this->assertInstanceOf(Auth::class, $auth);
        $this->assertEquals('foo', $auth->getRealm());
    }

    public function testWithUsername()
    {
        $auth = Auth::basic()->withUsername('foo');
        $this->assertInstanceOf(Auth::class, $auth);
        $this->assertEquals('foo', $auth->getUsername());
    }

    public function testWithPassword()
    {
        $auth = Auth::basic()->withPassword('foo');
        $this->assertInstanceOf(Auth::class, $auth);
        $this->assertEquals('foo', $auth->getPassword());
    }

    public function testWithCredentials()
    {
        $auth = Auth::basic()->withCredentials('foo', 'bar');
        $this->assertInstanceOf(Auth::class, $auth);
        $this->assertEquals('foo', $auth->getUsername());
        $this->assertEquals('bar', $auth->getPassword());
    }
}
