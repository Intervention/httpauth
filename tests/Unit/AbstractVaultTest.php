<?php

namespace Intervention\HttpAuth\Test\Unit;

use Intervention\HttpAuth\AbstractVault;
use PHPUnit\Framework\TestCase;

final class AbstractVaultTest extends TestCase
{
    public function testConstructor(): void
    {
        $vault = $this->getMockForAbstractClass(
            AbstractVault::class,
            ['myRealm', 'myUsername', 'myPassword']
        );

        $this->assertEquals('myUsername', $vault->getUsername());
        $this->assertEquals('myPassword', $vault->getPassword());
        $this->assertEquals('myRealm', $vault->getRealm());
    }

    public function testSetGetUsername(): void
    {
        $vault = $this->getMockForAbstractClass(
            AbstractVault::class,
            ['myRealm', 'myUsername', 'myPassword']
        );
        $vault->withUsername('foo');
        $this->assertEquals('foo', $vault->getUsername());
    }

    public function testSetGetPassword(): void
    {
        $vault = $this->getMockForAbstractClass(
            AbstractVault::class,
            ['myRealm', 'myUsername', 'myPassword']
        );
        $vault->withPassword('foo');
        $this->assertEquals('foo', $vault->getPassword());
    }

    public function testSetGetRealm(): void
    {
        $vault = $this->getMockForAbstractClass(
            AbstractVault::class,
            ['myRealm', 'myUsername', 'myPassword']
        );
        $vault->withRealm('foo');
        $this->assertEquals('foo', $vault->getRealm());
    }
}
