<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Tests\Unit\Tokens;

use Intervention\HttpAuth\Exceptions\AuthentificationException;
use Intervention\HttpAuth\Tests\TestCase;
use Intervention\HttpAuth\Tokens\HttpAuthorization;

final class HttpAuthorizationTest extends TestCase
{
    public function testParse(): void
    {
        $this->setServerVars([
            'HTTP_AUTHORIZATION' => 'Digest realm="test",qop="auth",nonce="xxxxxxxxxxxxx",' .
                'opaque="yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy"',
        ]);

        $token = new HttpAuthorization();
        $this->assertEquals('test', $token->realm());
        $this->assertEquals('auth', $token->qop());
        $this->assertEquals('xxxxxxxxxxxxx', $token->nonce());
        $this->assertEquals('yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy', $token->opaque());
    }

    public function testParseFailed(): void
    {
        $this->setServerVars([]);
        $this->expectException(AuthentificationException::class);
        new HttpAuthorization();
    }
}
