<?php

namespace Intervention\HttpAuth\Test\Token;

use Intervention\HttpAuth\Exception\AuthentificationException;
use Intervention\HttpAuth\Key;
use Intervention\HttpAuth\Token\HttpAuthorization;
use PHPUnit\Framework\TestCase;

class HttpAuthorizationTest extends AbstractTokenTestCase
{
    public function testParseFail()
    {
        $this->expectException(AuthentificationException::class);
        $auth = new HttpAuthorization;
    }

    public function testParse()
    {
        $auth = $this->getTestToken();
        $this->assertInstanceOf(HttpAuthorization::class, $auth);
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
        $this->setServerVars([
            'HTTP_AUTHORIZATION' => 'Digest realm="test",qop="auth",nonce="xxxxxxxxxxxxx",opaque="yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy"'
        ]);

        return new HttpAuthorization;
    }
}
