<?php

namespace Intervention\HttpAuth\Test;

use Intervention\HttpAuth\Configurator\Configurator;
use Intervention\HttpAuth\Directive;
use PHPUnit\Framework\TestCase;

class ConfiguratorTest extends TestCase
{
    public function testConstructor()
    {
        $configurator = new Configurator;
        $this->assertInstanceOf(Configurator::class, $configurator);
    }
}
