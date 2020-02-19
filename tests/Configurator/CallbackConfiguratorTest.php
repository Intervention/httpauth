<?php

namespace Intervention\HttpAuth\Test;

use Intervention\HttpAuth\Configurator\CallbackConfigurator;
use Intervention\HttpAuth\Directive;
use Intervention\HttpAuth\Vault\BasicVault;
use Intervention\HttpAuth\Vault\DigestVault;
use PHPUnit\Framework\TestCase;

class CallbackConfiguratorTest extends TestCase
{
    public function testConfigure()
    {
        $configurator = new CallbackConfigurator;
        $this->assertInstanceOf(CallbackConfigurator::class, $configurator);
        
        $result = $configurator->configure(function ($config) {
            $config->type('test1');
            $config->realm('test2');
            $config->username('test3');
            $config->password('test4');
            $config->password('test4');
        });

        $this->assertInstanceOf(CallbackConfigurator::class, $result);
        $this->assertEquals('test1', $configurator->getType());
        $this->assertEquals('test2', $configurator->getRealm());
        $this->assertEquals('test3', $configurator->getUsername());
        $this->assertEquals('test4', $configurator->getPassword());
    }
}
