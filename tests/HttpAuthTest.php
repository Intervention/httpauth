<?php

namespace Intervention\HttpAuth\Test;

use Intervention\HttpAuth\HttpAuth as Auth;
use Intervention\HttpAuth\Vault\BasicVault;
use Intervention\HttpAuth\Vault\DigestVault;
use PHPUnit\Framework\TestCase;

class HttpAuthTest extends TestCase
{
    public function testMake()
    {
        $this->assertInstanceOf(BasicVault::class, Auth::make());
        $this->assertInstanceOf(DigestVault::class, Auth::make(['type' => 'digest']));
    }

    public function testBasic()
    {
        $this->assertInstanceOf(BasicVault::class, Auth::basic());
    }

    public function testDigest()
    {
        $this->assertInstanceOf(DigestVault::class, Auth::digest());
    }

    public function testMagicCallStatic()
    {
        $vault = Auth::username('foo');
        $this->assertInstanceOf(BasicVault::class, $vault);
        $this->assertEquals('foo', $vault->getUsername());
    }

    public function testMagicCall()
    {
        $vault = (new Auth)->username('foo');
        $this->assertInstanceOf(BasicVault::class, $vault);
        $this->assertEquals('foo', $vault->getUsername());
    }

    public function testCallConfiguration()
    {
        $vault = Auth::digest()->username('foo')->password('bar')->realm('baz');
        $this->assertInstanceOf(DigestVault::class, $vault);
        $this->assertEquals('foo', $vault->getUsername());
        $this->assertEquals('bar', $vault->getPassword());
        $this->assertEquals('baz', $vault->getRealm());

        $vault = Auth::digest();
        $vault->username('foo');
        $vault->password('bar');
        $vault->realm('baz');
        $this->assertInstanceOf(DigestVault::class, $vault);
        $this->assertEquals('foo', $vault->getUsername());
        $this->assertEquals('bar', $vault->getPassword());
        $this->assertEquals('baz', $vault->getRealm());
    }
}
