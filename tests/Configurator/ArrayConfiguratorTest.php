<?php

namespace Intervention\HttpAuth\Test;

use Intervention\HttpAuth\Configurator\ArrayConfigurator;
use Intervention\HttpAuth\Directive;
use Intervention\HttpAuth\Vault\BasicVault;
use Intervention\HttpAuth\Vault\DigestVault;
use PHPUnit\Framework\TestCase;

class ArrayConfiguratorTest extends TestCase
{
    public function testConstructor()
    {
        $configurator = new ArrayConfigurator;
        $this->assertInstanceOf(ArrayConfigurator::class, $configurator);
    }

    public function testGetVault()
    {
        $configurator = new ArrayConfigurator;
        $this->assertInstanceOf(BasicVault::class, $configurator->getVault());

        $configurator->type('digest');
        $this->assertInstanceOf(DigestVault::class, $configurator->getVault());
    }

    public function testType()
    {
        $configurator = new ArrayConfigurator;
        $this->assertEquals('basic', $configurator->getType());

        $result = $configurator->type('foo');
        $this->assertEquals('foo', $configurator->getType());
        $this->assertInstanceOf(ArrayConfigurator::class, $result);
    }

    public function testRealm()
    {
        $configurator = new ArrayConfigurator;
        $this->assertEquals('Secured Resource', $configurator->getRealm());

        $result = $configurator->realm('foo');
        $this->assertEquals('foo', $configurator->getRealm());
        $this->assertInstanceOf(ArrayConfigurator::class, $result);
    }

    public function testUsername()
    {
        $configurator = new ArrayConfigurator;
        $this->assertEquals('admin', $configurator->getUsername());

        $result = $configurator->username('foo');
        $this->assertEquals('foo', $configurator->getUsername());
        $this->assertInstanceOf(ArrayConfigurator::class, $result);
    }

    public function testPassword()
    {
        $configurator = new ArrayConfigurator;
        $this->assertEquals('secret', $configurator->getPassword());

        $result = $configurator->password('foo');
        $this->assertEquals('foo', $configurator->getPassword());
        $this->assertInstanceOf(ArrayConfigurator::class, $result);
    }
}
