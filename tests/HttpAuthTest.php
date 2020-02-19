<?php

namespace Intervention\HttpAuth\Test;

use Intervention\HttpAuth\HttpAuth;
use Intervention\HttpAuth\Vault\BasicVault;
use Intervention\HttpAuth\Vault\DigestVault;
use PHPUnit\Framework\TestCase;

class HttpAuthTest extends TestCase
{
    public function testMake()
    {
        $this->assertInstanceOf(BasicVault::class, HttpAuth::make());
        $this->assertInstanceOf(DigestVault::class, HttpAuth::make(['type' => 'digest']));
    }

    public function testBasic()
    {
        $this->assertInstanceOf(BasicVault::class, HttpAuth::basic());
    }

    public function testDigest()
    {
        $this->assertInstanceOf(DigestVault::class, HttpAuth::digest());
    }

    public function testMagicCall()
    {
        $vault = HttpAuth::username('foo');
        $this->assertInstanceOf(BasicVault::class, $vault);
        $this->assertEquals('foo', $vault->getUsername());
    }

    public function testCallConfiguration()
    {
        $vault = HttpAuth::digest()->username('foo')->password('bar')->realm('baz');
        $this->assertInstanceOf(DigestVault::class, $vault);
        $this->assertEquals('foo', $vault->getUsername());
        $this->assertEquals('bar', $vault->getPassword());
        $this->assertEquals('baz', $vault->getRealm());

        $vault = HttpAuth::digest();
        $vault->username('foo');
        $vault->password('bar');
        $vault->realm('baz');
        $this->assertInstanceOf(DigestVault::class, $vault);
        $this->assertEquals('foo', $vault->getUsername());
        $this->assertEquals('bar', $vault->getPassword());
        $this->assertEquals('baz', $vault->getRealm());
    }
}
