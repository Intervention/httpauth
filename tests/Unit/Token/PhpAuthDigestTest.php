<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Tests\Unit\Token;

use Intervention\HttpAuth\Exceptions\AuthentificationException;
use Intervention\HttpAuth\Tests\TestCase;
use Intervention\HttpAuth\Token\PhpAuthDigest;

final class PhpAuthDigestTest extends TestCase
{
    public function testParse(): void
    {
        $this->setServerVars([
            'PHP_AUTH_DIGEST' => 'realm="test",qop="auth",nonce="xxxxxxxxxxxxx",' .
                'opaque="yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy"'
        ]);

        $token = new PhpAuthDigest();
        $this->assertEquals('test', $token->realm());
        $this->assertEquals('auth', $token->qop());
        $this->assertEquals('xxxxxxxxxxxxx', $token->nonce());
        $this->assertEquals('yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy', $token->opaque());
    }

    public function testParseFailed(): void
    {
        $this->setServerVars([]);
        $this->expectException(AuthentificationException::class);
        new PhpAuthDigest();
    }
}
