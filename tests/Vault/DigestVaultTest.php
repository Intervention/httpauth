<?php

namespace Intervention\HttpAuth\Test\Vault;

use Intervention\HttpAuth\Vault\DigestVault as Vault;
use Intervention\HttpAuth\Directive;
use Intervention\HttpAuth\Key;
use PHPUnit\Framework\TestCase;

class DigestVaultTest extends TestCase
{
    public function testGetDirective()
    {
        $vault = new Vault('myRealm', 'myUsername', 'myPassword');
        $directive = $vault->getDirective();
        $this->assertInstanceOf(Directive::class, $directive);
        $this->assertEquals('digest', $directive->getType());
        $this->assertEquals('myRealm', $directive->getParameter('realm'));
        $this->assertEquals('auth', $directive->getParameter('qop'));
        $this->assertRegExp("/^[a-z0-9]{13}$/", $directive->getParameter('nonce'));
        $this->assertRegExp("/^[a-z0-9]{32}$/", $directive->getParameter('opaque'));
    }

    public function testUnlocksWithKey()
    {
        $vault = new Vault('myRealm', 'myUsername', 'myPassword');
        $key = new Key;
        
        $key->setProperty('username', 'myUsername');
        $key->setProperty('response', 'xx');
        $key->setProperty('nonce', 'myNonce');
        $key->setProperty('nc', 'myNc');
        $key->setProperty('cnonce', 'myCnonce');
        $key->setProperty('qop', 'myQop');
        $key->setProperty('uri', 'myUri');
        $this->assertFalse($vault->unlocksWithKey($key));

        $key->setProperty('response', 'f1d34edc18506c758600fe1233d1c1b3');
        $this->assertTrue($vault->unlocksWithKey($key));
    }
}
