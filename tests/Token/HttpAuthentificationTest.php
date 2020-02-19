<?php

namespace Intervention\HttpAuth\Test\Token;

use Exception;
use Intervention\HttpAuth\Token\HttpAuthentification;
use Intervention\HttpAuth\Key;
use PHPUnit\Framework\TestCase;

class HttpAuthentificationTest extends AbstractTokenTestCase
{
    public function testParseFail()
    {
        $this->expectException(Exception::class);
        $auth = new HttpAuthentification;
    }

    public function testParse()
    {
        $auth = $this->getTestToken();
        $this->assertInstanceOf(HttpAuthentification::class, $auth);
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
            'HTTP_AUTHENTICATION' => 'basic_' . base64_encode(implode(':', [
                'test_username',
                'test_password'
            ])),
        ]);

        return new HttpAuthentification;
    }
}
