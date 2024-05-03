<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Tests\Unit\Token;

use Intervention\HttpAuth\Exception\AuthentificationException;
use Intervention\HttpAuth\Tests\TestCase;
use Intervention\HttpAuth\Token\PhpAuthUser;

final class PhpAuthUserTest extends TestCase
{
    public function testParse(): void
    {
        $this->setServerVars([
            'PHP_AUTH_USER' => 'myUser',
            'PHP_AUTH_PW' => 'myPassword',
        ]);

        $token = new PhpAuthUser();
        $this->assertEquals('myUser', $token->username());
        $this->assertEquals('myPassword', $token->password());
    }

    public function testParseFailed(): void
    {
        $this->setServerVars([]);
        $this->expectException(AuthentificationException::class);
        new PhpAuthUser();
    }
}
