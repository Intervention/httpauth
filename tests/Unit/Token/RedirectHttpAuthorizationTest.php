<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Tests\Unit\Token;

use Intervention\HttpAuth\Test\AbstractTokenTestCase;
use Intervention\HttpAuth\Exception\AuthentificationException;
use Intervention\HttpAuth\Key;
use Intervention\HttpAuth\Token\RedirectHttpAuthorization;

final class RedirectHttpAuthorizationTest extends AbstractTokenTestCase
{
    public function testGetKeyFail(): void
    {
        $this->expectException(AuthentificationException::class);
        $token = new RedirectHttpAuthorization();
        $token->getKey();
    }

    public function testGetKey(): void
    {
        $key = $this->getTestToken()->getKey();
        $this->assertInstanceOf(Key::class, $key);
        $this->assertEquals('test_username', $key->getUsername());
        $this->assertEquals('test_password', $key->getPassword());
    }

    private function getTestToken(): RedirectHttpAuthorization
    {
        $this->setServerVars([
            'REDIRECT_HTTP_AUTHORIZATION' => 'basic_' . base64_encode(implode(':', [
                'test_username',
                'test_password'
            ])),
        ]);

        return new RedirectHttpAuthorization();
    }
}
