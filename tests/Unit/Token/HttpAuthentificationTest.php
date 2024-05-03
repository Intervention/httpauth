<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Tests\Unit\Token;

use Intervention\HttpAuth\Exception\AuthentificationException;
use Intervention\HttpAuth\Tests\TestCase;
use Intervention\HttpAuth\Token\HttpAuthentification;

final class HttpAuthentificationTest extends TestCase
{
    public function testParse(): void
    {
        $this->setServerVars([
            'HTTP_AUTHENTICATION' => 'basic_' . base64_encode(implode(':', [
                'myUser',
                'myPassword',
            ])),
        ]);

        $token = new HttpAuthentification();
        $this->assertEquals('myUser', $token->username());
        $this->assertEquals('myPassword', $token->password());
    }

    public function testParseFailed(): void
    {
        $this->setServerVars([]);
        $this->expectException(AuthentificationException::class);
        new HttpAuthentification();
    }
}
