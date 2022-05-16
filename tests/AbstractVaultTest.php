<?php

namespace Intervention\HttpAuth\Test;

use Intervention\HttpAuth\AbstractVault;
use Intervention\HttpAuth\Key;
use PHPUnit\Framework\TestCase;

class AbstractVaultTest extends TestCase
{
    public function testConstructor()
    {
        $vault = $this->getMockForAbstractClass(
            AbstractVault::class,
            ['myRealm', 'myUsername', 'myPassword']
        );

        $this->assertEquals('myUsername', $vault->getUsername());
        $this->assertEquals('myPassword', $vault->getPassword());
        $this->assertEquals('myRealm', $vault->getRealm());
    }

    public function testGetKey()
    {
        $vault = $this->getMockForAbstractClass(
            AbstractVault::class,
            ['myRealm', 'myUsername', 'myPassword']
        );

        $this->assertInstanceOf(Key::class, $vault->getKey());
    }

    public function testSetGetUsername()
    {
        $vault = $this->getMockForAbstractClass(
            AbstractVault::class,
            ['myRealm', 'myUsername', 'myPassword']
        );
        $vault->withUsername('foo');
        $this->assertEquals('foo', $vault->getUsername());
    }

    public function testSetGetPassword()
    {
        $vault = $this->getMockForAbstractClass(
            AbstractVault::class,
            ['myRealm', 'myUsername', 'myPassword']
        );
        $vault->withPassword('foo');
        $this->assertEquals('foo', $vault->getPassword());
    }

    public function testSetGetRealm()
    {
        $vault = $this->getMockForAbstractClass(
            AbstractVault::class,
            ['myRealm', 'myUsername', 'myPassword']
        );
        $vault->withRealm('foo');
        $this->assertEquals('foo', $vault->getRealm());
    }
}
