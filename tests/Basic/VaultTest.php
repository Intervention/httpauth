<?php

namespace Intervention\Httpauth\Test\Basic;

use Intervention\Httpauth\Basic\Vault;
use Intervention\Httpauth\Directive;
use Intervention\Httpauth\Key;
use Intervention\Httpauth\Test\AbstractVaultTestCase;
use PHPUnit\Framework\TestCase;

class VaultTest extends AbstractVaultTestCase
{
    public function testDecodeKeyValueEmpty()
    {
        $vault = new Vault('myRealm', 'myUsername', 'myPassword');
        $key = $vault->decodeKeyValue('test');
        $this->assertInstanceOf(Key::class, $key);
    }

    public function testDecodeKeyValuePhpAuthUser()
    {
        $this->setServerVars([
            'PHP_AUTH_USER' => 'test_username',
            'PHP_AUTH_PW' => 'test_password',
        ]);

        $vault = new Vault('myRealm', 'myUsername', 'myPassword');
        $key = $vault->decodeKeyValue($this->getKeyValue());
        $this->assertInstanceOf(Key::class, $key);
        $this->assertEquals('test_username', $key->getUsername());
        $this->assertEquals('test_password', $key->getPassword());
    }

    public function testDecodeKeyValueHttpAuthentication()
    {
        $this->setServerVars([
            'HTTP_AUTHENTICATION' => 'basic_' . base64_encode(implode(':', [
                'test_username',
                'test_password'
            ])),
        ]);

        $vault = new Vault('myRealm', 'myUsername', 'myPassword');
        $key = $vault->decodeKeyValue($this->getKeyValue());
        $this->assertInstanceOf(Key::class, $key);
        $this->assertEquals('test_username', $key->getUsername());
        $this->assertEquals('test_password', $key->getPassword());
    }

    public function testDecodeKeyValueRedirectHttpAuthorization()
    {
        $this->setServerVars([
            'REDIRECT_HTTP_AUTHORIZATION' => 'basic_' . base64_encode(implode(':', [
                'test_username',
                'test_password'
            ])),
        ]);

        $vault = new Vault('myRealm', 'myUsername', 'myPassword');
        $key = $vault->decodeKeyValue($this->getKeyValue());
        $this->assertInstanceOf(Key::class, $key);
        $this->assertEquals('test_username', $key->getUsername());
        $this->assertEquals('test_password', $key->getPassword());
    }

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
