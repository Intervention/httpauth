<?php

namespace Intervention\Httpauth\Test\Basic;

use Intervention\Httpauth\Basic\Vault as BasicVault;
use Intervention\Httpauth\Basic\Credentials;
use PHPUnit\Framework\TestCase;

class VaultTest extends TestCase
{
    public function testGetDirective()
    {
        $vault = new BasicVault;
        $vault->setName('foobar');
        $this->assertEquals('Basic realm="foobar", charset="UTF-8"', $vault->getDirective());
    }

    public function testGetAuthTypeAuthUser()
    {
        $this->setServerVars([
            'PHP_AUTH_USER' => 'test_user',
            'PHP_AUTH_PW' => 'test_password',
        ]);

        $vault = new BasicVault;
        $authentication = $vault->getAuth();
        $this->assertInstanceOf(Credentials::class, $authentication);
        $this->assertEquals('test_user', $authentication->get('username'));
        $this->assertEquals('test_password', $authentication->get('password'));
    }

    public function testGetAuthTypeAuthentication()
    {
        $this->setServerVars([
            'HTTP_AUTHENTICATION' => 'basic_' . base64_encode(implode(':', [
                'test_username',
                'test_password'
            ])),
        ]);

        $vault = new BasicVault;
        $authentication = $vault->getAuth();
        $this->assertInstanceOf(Credentials::class, $authentication);
        $this->assertEquals('test_username', $authentication->get('username'));
        $this->assertEquals('test_password', $authentication->get('password'));
    }

    public function testGetAuthTypeRedirect()
    {
        $this->setServerVars([
            'REDIRECT_HTTP_AUTHORIZATION' => 'basic_' . base64_encode(implode(':', [
                'test_username',
                'test_password'
            ]))
        ]);

        $vault = new BasicVault;
        $authentication = $vault->getAuth();
        $this->assertInstanceOf(Credentials::class, $authentication);
        $this->assertEquals('test_username', $authentication->get('username'));
        $this->assertEquals('test_password', $authentication->get('password'));
    }

    private function setServerVars($values = [])
    {
        unset($_SERVER['PHP_AUTH_DIGEST']);
        unset($_SERVER['HTTP_AUTHORIZATION']);
        unset($_SERVER['PHP_AUTH_USER']);
        unset($_SERVER['PHP_AUTH_PW']);
        unset($_SERVER['HTTP_AUTHENTICATION']);
        unset($_SERVER['REDIRECT_HTTP_AUTHORIZATION']);

        foreach ($values as $key => $value) {
            $_SERVER[$key] = $value;
        }
    }
}
