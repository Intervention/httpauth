<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Tests\Unit\Token;

use Intervention\HttpAuth\Tests\AbstractTokenTestCase;
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
        $this->assertEquals('test_username', $key->username());
        $this->assertEquals('test_password', $key->password());
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
