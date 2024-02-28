<?php

namespace Intervention\HttpAuth\Test\Unit\Token;

use Intervention\HttpAuth\Test\AbstractTokenTestCase;
use Intervention\HttpAuth\Exception\AuthentificationException;
use Intervention\HttpAuth\Key;
use Intervention\HttpAuth\Token\PhpAuthUser;

final class PhpAuthUserTest extends AbstractTokenTestCase
{
    public function testGetKeyFail(): void
    {
        $this->expectException(AuthentificationException::class);
        $token = new PhpAuthUser();
        $token->getKey();
    }

    public function testGetKey(): void
    {
        $key = $this->getTestToken()->getKey();
        $this->assertInstanceOf(Key::class, $key);
        $this->assertEquals('test_username', $key->getUsername());
        $this->assertEquals('test_password', $key->getPassword());
    }

    private function getTestToken(): PhpAuthUser
    {
        $this->setServerVars([
            'PHP_AUTH_USER' => 'test_username',
            'PHP_AUTH_PW' => 'test_password',
        ]);

        return new PhpAuthUser();
    }
}
