<?php

namespace Intervention\HttpAuth\Test\Unit\Token;

use Intervention\HttpAuth\Test\AbstractTokenTestCase;
use Intervention\HttpAuth\Exception\AuthentificationException;
use Intervention\HttpAuth\Key;
use Intervention\HttpAuth\Token\HttpAuthentification;

final class HttpAuthentificationTest extends AbstractTokenTestCase
{
    public function testGetKeyFail(): void
    {
        $this->expectException(AuthentificationException::class);
        $token = new HttpAuthentification();
        $token->getKey();
    }

    public function testGetKey(): void
    {
        $key = $this->getTestToken()->getKey();
        $this->assertInstanceOf(Key::class, $key);
        $this->assertEquals('test_username', $key->getUsername());
        $this->assertEquals('test_password', $key->getPassword());
    }

    private function getTestToken(): HttpAuthentification
    {
        $this->setServerVars([
            'HTTP_AUTHENTICATION' => 'basic_' . base64_encode(implode(':', [
                'test_username',
                'test_password',
            ])),
        ]);

        return new HttpAuthentification();
    }
}
