<?php

namespace Intervention\Httpauth\Test;

use Intervention\Httpauth\AbstractVault;
use Intervention\Httpauth\Key;
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

    public function testSetGetUsername()
    {
        $vault = $this->getMockForAbstractClass(
            AbstractVault::class,
            ['myRealm', 'myUsername', 'myPassword']
        );
        $vault->setUsername('foo');
        $this->assertEquals('foo', $vault->getUsername());
    }

    public function testSetGetPassword()
    {
        $vault = $this->getMockForAbstractClass(
            AbstractVault::class,
            ['myRealm', 'myUsername', 'myPassword']
        );
        $vault->setPassword('foo');
        $this->assertEquals('foo', $vault->getPassword());
    }

    public function testSetGetRealm()
    {
        $vault = $this->getMockForAbstractClass(
            AbstractVault::class,
            ['myRealm', 'myUsername', 'myPassword']
        );
        $vault->setRealm('foo');
        $this->assertEquals('foo', $vault->getRealm());
    }
}
