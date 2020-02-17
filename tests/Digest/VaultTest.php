<?php

namespace Intervention\Httpauth\Test\Digest;

use Intervention\Httpauth\Digest\Vault as DigestVault;
use Intervention\Httpauth\Digest\Credentials;
use PHPUnit\Framework\TestCase;

class VaultTest extends TestCase
{
    public function testGetDirective()
    {
        $vault = new DigestVault;
        $vault->setName('foobar');

        $directive = 'Digest realm="foobar",qop="auth",nonce="5e4a8a6880bf2",opaque="3858f62230ac3c915f300c664312c63f"';
        $this->assertRegExp("/^Digest realm=\"foobar\",qop=\"auth\",nonce=\"[a-z0-9]{13}\",opaque=\"3858f62230ac3c915f300c664312c63f\"$/", $vault->getDirective());
    }

    public function testGetAuthTypeAuthDigest()
    {
        $this->setServerVars(['PHP_AUTH_DIGEST' => $this->getTestAuthValue()]);

        $vault = new DigestVault;
        $auth = $vault->getAuth();
        $this->assertInstanceOf(Credentials::class, $auth);
        $this->assertEquals('test', $auth->get('realm'));
        $this->assertEquals('auth', $auth->get('qop'));
        $this->assertEquals('xxxxxxxxxxxxx', $auth->get('nonce'));
        $this->assertEquals('yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy', $auth->get('opaque'));
    }

    public function testGetAuthTypeAuthorization()
    {
        $this->setServerVars(['HTTP_AUTHORIZATION' => $this->getTestAuthValue()]);
        $vault = new DigestVault;
        $auth = $vault->getAuth();
        $this->assertInstanceOf(Credentials::class, $auth);
        $this->assertEquals('test', $auth->get('realm'));
        $this->assertEquals('auth', $auth->get('qop'));
        $this->assertEquals('xxxxxxxxxxxxx', $auth->get('nonce'));
        $this->assertEquals('yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy', $auth->get('opaque'));
    }

    private function getTestAuthValue()
    {
        return 'Digest realm="test",qop="auth",nonce="xxxxxxxxxxxxx",opaque="yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy"';
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
