<?php

namespace Intervention\HttpAuth\Test\Token;

use Intervention\HttpAuth\Exception\AuthentificationException;
use Intervention\HttpAuth\Key;
use Intervention\HttpAuth\Token\RedirectHttpAuthorization;
use PHPUnit\Framework\TestCase;

class RedirectHttpAuthorizationTest extends AbstractTokenTestCase
{
    public function testParseFail()
    {
        $this->expectException(AuthentificationException::class);
        $auth = new RedirectHttpAuthorization();
    }

    public function testParse()
    {
        $auth = $this->getTestToken();
        $this->assertInstanceOf(RedirectHttpAuthorization::class, $auth);
    }

    public function testToKey()
    {
        $key = $this->getTestToken()->toKey();
        $this->assertInstanceOf(Key::class, $key);
        $this->assertEquals('test_username', $key->getUsername());
        $this->assertEquals('test_password', $key->getPassword());
    }

    private function getTestToken()
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
