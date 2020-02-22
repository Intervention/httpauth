<?php

namespace Intervention\HttpAuth\Test;

use Intervention\HttpAuth\Exception\NotSupportedException;
use Intervention\HttpAuth\HttpAuth as Auth;
use Intervention\HttpAuth\Vault\BasicVault;
use Intervention\HttpAuth\Vault\DigestVault;
use PHPUnit\Framework\TestCase;

class HttpAuthTest extends TestCase
{
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
