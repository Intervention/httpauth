<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Tests\Unit\Token;

use Intervention\HttpAuth\Tests\AbstractTokenTestCase;
use Intervention\HttpAuth\Exception\AuthentificationException;
use Intervention\HttpAuth\Key;
use Intervention\HttpAuth\Token\HttpAuthorization;

final class HttpAuthorizationTest extends AbstractTokenTestCase
{
    public function testGetKeyFail(): void
    {
        $this->expectException(AuthentificationException::class);
        $token = new HttpAuthorization();
        $token->getKey();
    }

    public function testGetKey(): void
    {
        $key = $this->getTestToken()->getKey();
        $this->assertInstanceOf(Key::class, $key);
        $this->assertEquals('test', $key->getRealm());
        $this->assertEquals('auth', $key->getQop());
        $this->assertEquals('xxxxxxxxxxxxx', $key->getNonce());
        $this->assertEquals('yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy', $key->getOpaque());
    }

    private function getTestToken()
    {
        $auth = 'Digest realm="test",qop="auth",nonce="xxxxxxxxxxxxx",opaque="yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy"';
        $this->setServerVars([
            'HTTP_AUTHORIZATION' => $auth
        ]);

        return new HttpAuthorization();
    }
}
