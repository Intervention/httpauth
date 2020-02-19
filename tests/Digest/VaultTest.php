<?php

namespace Intervention\Httpauth\Test\Digest;

use Intervention\Httpauth\Digest\Vault;
use Intervention\Httpauth\Directive;
use Intervention\Httpauth\Key;
use Intervention\Httpauth\Test\AbstractVaultTestCase;
use PHPUnit\Framework\TestCase;

class VaultTest extends AbstractVaultTestCase
{
    const TEST_AUTH_VALUE = 'Digest realm="test",qop="auth",nonce="xxxxxxxxxxxxx",opaque="yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy"';

    public function testDecodeKeyValueEmpty()
    {
        $vault = new Vault('myRealm', 'myUsername', 'myPassword');
        $key = $vault->decodeKeyValue($this->getKeyValue());
        $this->assertInstanceOf(Key::class, $key);
    }

    public function testDecodeKeyValuePhpAuthDigest()
    {
        $this->setServerVars(['PHP_AUTH_DIGEST' => self::TEST_AUTH_VALUE]);

        $vault = new Vault('myRealm', 'myUsername', 'myPassword');
        $key = $vault->decodeKeyValue($this->getKeyValue());
        $this->assertInstanceOf(Key::class, $key);
        $this->assertEquals('test', $key->getRealm());
        $this->assertEquals('auth', $key->getQop());
        $this->assertEquals('xxxxxxxxxxxxx', $key->getNonce());
        $this->assertEquals('yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy', $key->getOpaque());
    }

    public function testDecodeKeyValueHttpAuthorization()
    {
        $this->setServerVars(['HTTP_AUTHORIZATION' => self::TEST_AUTH_VALUE]);

        $vault = new Vault('myRealm', 'myUsername', 'myPassword');
        $key = $vault->decodeKeyValue($this->getKeyValue());
        $this->assertInstanceOf(Key::class, $key);
        $this->assertEquals('test', $key->getRealm());
        $this->assertEquals('auth', $key->getQop());
        $this->assertEquals('xxxxxxxxxxxxx', $key->getNonce());
        $this->assertEquals('yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy', $key->getOpaque());
    }

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
