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

    public function testMagicCalls()
    {
        $vault = HttpAuth::username('foo');
        $this->assertInstanceOf(BasicVault::class, $vault);
        $this->assertEquals('foo', $vault->getUsername());
    }
}
