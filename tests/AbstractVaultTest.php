<?php

namespace Intervention\Httpauth\Test;

use Intervention\Httpauth\AbstractVault;
use Intervention\Httpauth\Basic\Credentials;
use PHPUnit\Framework\TestCase;

class AbstractVaultTest extends TestCase
{
    public function testSetCredentials()
    {
        $vault = $this->getMockForAbstractClass(AbstractVault::class);
        $vault->setCredentials(new Credentials(['username' => 'foo', 'password' => 'bar']));
        $this->assertEquals('foo', $vault->getCredentials()->get('username'));
        $this->assertEquals('bar', $vault->getCredentials()->get('password'));
    }

    public function testSetUsername()
    {
        $vault = $this->getMockForAbstractClass(AbstractVault::class);
        $vault->setCredentials(new Credentials(['username' => 'foo', 'password' => 'bar']));
        $vault->setUsername('baz');
        $this->assertEquals('baz', $vault->getCredentials()->get('username'));
    }

    public function testSetPassword()
    {
        $vault = $this->getMockForAbstractClass(AbstractVault::class);
        $vault->setCredentials(new Credentials(['username' => 'foo', 'password' => 'bar']));
        $vault->setPassword('baz');
        $this->assertEquals('baz', $vault->getCredentials()->get('password'));
    }

    public function testGetSetName()
    {
        $vault = $this->getMockForAbstractClass(AbstractVault::class);
        $this->assertNull($vault->getName());

        $result = $vault->setName('foo');
        $this->assertEquals('foo', $vault->getName());
        $this->assertInstanceOf(AbstractVault::class, $result);
    }
}
