<?php

namespace Intervention\Httpauth\Test\Basic;

use Intervention\Httpauth\Methods\Basic\Vault;
use Intervention\Httpauth\Directive;
use Intervention\Httpauth\Key;
use PHPUnit\Framework\TestCase;

class VaultTest extends TestCase
{
    public function testGetDirective()
    {
        $vault = new Vault('myRealm', 'myUsername', 'myPassword');
        $directive = $vault->getDirective();
        $this->assertInstanceOf(Directive::class, $directive);
        $this->assertEquals('basic', $directive->getType());
        $this->assertEquals('myRealm', $directive->getParameter('realm'));
    }

    public function testUnlocksWithKey()
    {
        $key = new Key;
        $key->setProperty('username', 'myUsername');
        $key->setProperty('password', 'foo');
        $vault = new Vault('myRealm', 'myUsername', 'myPassword');
        $this->assertFalse($vault->unlocksWithKey($key));

        $key->setProperty('password', 'myPassword');
        $this->assertTrue($vault->unlocksWithKey($key));
    }
}
