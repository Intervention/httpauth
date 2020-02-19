<?php

namespace Intervention\HttpAuth\Test\Token;

use Exception;
use Intervention\HttpAuth\Token\PhpAuthUser;
use Intervention\HttpAuth\Key;
use PHPUnit\Framework\TestCase;

class PhpAuthUserTest extends AbstractTokenTestCase
{
    public function testParseFail()
    {
        $this->expectException(Exception::class);
        $auth = new PhpAuthUser;
    }

    public function testParse()
    {
        $auth = $this->getTestToken();
        $this->assertInstanceOf(PhpAuthUser::class, $auth);
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
            'PHP_AUTH_USER' => 'test_username',
            'PHP_AUTH_PW' => 'test_password',
        ]);

        return new PhpAuthUser;
    }
}
