<?php

namespace Intervention\HttpAuth\Test\Vault;

use Intervention\HttpAuth\Vault\BasicVault;
use Intervention\HttpAuth\Directive;
use Intervention\HttpAuth\Key;
use PHPUnit\Framework\TestCase;

class BasicVaultTest extends TestCase
{
    public function testGetDirective(): void
    {
        $vault = new BasicVault('myRealm', 'myUsername', 'myPassword');
        $directive = $vault->getDirective();
        $this->assertInstanceOf(Directive::class, $directive);
        $this->assertEquals('basic', $directive->getType());
        $this->assertEquals('myRealm', $directive->getParameter('realm'));
    }

    public function testUnlocksWithKey(): void
    {
        $key = new Key();
        $key->setProperty('username', 'myUsername');
        $key->setProperty('password', 'foo');
        $vault = new BasicVault('myRealm', 'myUsername', 'myPassword');
        $this->assertFalse($vault->unlocksWithKey($key));

        $key->setProperty('password', 'myPassword');
        $this->assertTrue($vault->unlocksWithKey($key));
    }
}
