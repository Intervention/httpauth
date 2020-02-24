<?php

namespace Intervention\HttpAuth\Test;

use Intervention\HttpAuth\Exception\NotSupportedException;
use Intervention\HttpAuth\HttpAuth as Auth;
use Intervention\HttpAuth\Vault\BasicVault;
use Intervention\HttpAuth\Vault\DigestVault;
use PHPUnit\Framework\TestCase;

class HttpAuthTest extends TestCase
{
    public function testMake()
    {
        $auth = Auth::make([
            'type' => 'digest',
            'realm' => 'foo',
            'username' => 'bar',
            'password' => 'baz',
        ]);

        $this->assertInstanceOf(Auth::class, $auth);
        $this->assertEquals('digest', $auth->getType());
        $this->assertEquals('foo', $auth->getRealm());
        $this->assertEquals('bar', $auth->getUsername());
        $this->assertEquals('baz', $auth->getPassword());

        // second make should overwrite just one parameter
        $auth = $auth->make(['username' => 'admin']);

        $this->assertEquals('digest', $auth->getType());
        $this->assertEquals('foo', $auth->getRealm());
        $this->assertEquals('admin', $auth->getUsername());
        $this->assertEquals('baz', $auth->getPassword());
    }

    public function testBasic()
    {
        $auth = Auth::make()->basic();
        $this->assertInstanceOf(Auth::class, $auth);
        $this->assertEquals('basic', $auth->getType());
    }

    public function testDigest()
    {
        $auth = Auth::make()->digest();
        $this->assertInstanceOf(Auth::class, $auth);
        $this->assertEquals('digest', $auth->getType());
    }

    public function testType()
    {
        $auth = Auth::make()->type('digest');
        $this->assertInstanceOf(Auth::class, $auth);
        $this->assertEquals('digest', $auth->getType());
    }

    public function testRealm()
    {
        $auth = Auth::make()->realm('foo');
        $this->assertInstanceOf(Auth::class, $auth);
        $this->assertEquals('foo', $auth->getRealm());
    }

    public function testUsername()
    {
        $auth = Auth::make()->username('foo');
        $this->assertInstanceOf(Auth::class, $auth);
        $this->assertEquals('foo', $auth->getUsername());
    }

    public function testPassword()
    {
        $auth = Auth::make()->password('foo');
        $this->assertInstanceOf(Auth::class, $auth);
        $this->assertEquals('foo', $auth->getPassword());
    }

    public function testCredentials()
    {
        $auth = Auth::make()->credentials('foo', 'bar');
        $this->assertInstanceOf(Auth::class, $auth);
        $this->assertEquals('foo', $auth->getUsername());
        $this->assertEquals('bar', $auth->getPassword());
    }
}
