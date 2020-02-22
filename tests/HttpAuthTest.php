<?php

namespace Intervention\HttpAuth\Test;

use Intervention\HttpAuth\Exception\NotSupportedException;
use Intervention\HttpAuth\HttpAuth as Auth;
use Intervention\HttpAuth\Vault\BasicVault;
use Intervention\HttpAuth\Vault\DigestVault;
use PHPUnit\Framework\TestCase;

class HttpAuthTest extends TestCase
{
    public function testMakeWithoutConfig()
    {
        $auth = Auth::make();
        $this->assertInstanceOf(Auth::class, $auth);
        $this->assertEquals('basic', $auth->getType());
        $this->assertEquals('Secured Resource', $auth->getRealm());
        $this->assertEquals('admin', $auth->getUsername());
        $this->assertEquals('secret', $auth->getPassword());
    }

    public function testMakeWithArray()
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
    }

    public function testMakeWithCallback()
    {
        $auth = Auth::make(function ($config) {
            $config->digest();
            $config->realm('foo');
            $config->username('bar');
            $config->password('baz');
        });
        $this->assertInstanceOf(Auth::class, $auth);
        $this->assertEquals('digest', $auth->getType());
        $this->assertEquals('foo', $auth->getRealm());
        $this->assertEquals('bar', $auth->getUsername());
        $this->assertEquals('baz', $auth->getPassword());
    }

    public function testMakeString()
    {
        $this->expectException(NotSupportedException::class);
        Auth::make('foo');
    }

    public function testMakeBoolean()
    {
        $this->expectException(NotSupportedException::class);
        Auth::make(false);
    }

    public function testMakeUnknownMethod()
    {
        $this->expectException(NotSupportedException::class);
        Auth::make(['type' => 'foo'])->secure();
    }
}
