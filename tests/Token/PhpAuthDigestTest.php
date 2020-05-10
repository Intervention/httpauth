<?php

namespace Intervention\HttpAuth\Test\Token;

use Intervention\HttpAuth\Exception\AuthentificationException;
use Intervention\HttpAuth\Key;
use Intervention\HttpAuth\Token\PhpAuthDigest;
use PHPUnit\Framework\TestCase;

class PhpAuthDigestTest extends AbstractTokenTestCase
{
    public function testParseFail()
    {
        $this->expectException(AuthentificationException::class);
        $auth = new PhpAuthDigest();
    }

    public function testParse()
    {
        $auth = $this->getTestToken();
        $this->assertInstanceOf(PhpAuthDigest::class, $auth);
    }

    public function testToKey()
    {
        $key = $this->getTestToken()->toKey();
        $this->assertInstanceOf(Key::class, $key);
        $this->assertEquals('test', $key->getRealm());
        $this->assertEquals('auth', $key->getQop());
        $this->assertEquals('xxxxxxxxxxxxx', $key->getNonce());
        $this->assertEquals('yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy', $key->getOpaque());
    }

    private function getTestToken()
    {
        $auth_digest = 'realm="test",qop="auth",nonce="xxxxxxxxxxxxx",opaque="yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy"';
        
        $this->setServerVars([
            'PHP_AUTH_DIGEST' => $auth_digest
        ]);

        return new PhpAuthDigest();
    }
}
