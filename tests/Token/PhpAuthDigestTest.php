<?php

namespace Intervention\Httpauth\Test\Token;

use Exception;
use Intervention\Httpauth\Token\PhpAuthDigest;
use Intervention\Httpauth\Key;
use PHPUnit\Framework\TestCase;

class PhpAuthDigestTest extends AbstractTokenTestCase
{
    public function testParseFail()
    {
        $this->expectException(Exception::class);
        $auth = new PhpAuthDigest;
    }

    public function testParse()
    {
        $auth = $this->getTestToken();
        $this->assertInstanceOf(PhpAuthDigest::class, $auth);
    }

    public function testToKey()
    {
        $key = $this->getTestToken()->toKey();
        $this->assertInstanceOf(Key::class, $key);
        $this->assertEquals('test', $key->getRealm());
        $this->assertEquals('auth', $key->getQop());
        $this->assertEquals('xxxxxxxxxxxxx', $key->getNonce());
        $this->assertEquals('yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy', $key->getOpaque());
    }

    private function getTestToken()
    {
        $this->setServerVars([
            'PHP_AUTH_DIGEST' => 'realm="test",qop="auth",nonce="xxxxxxxxxxxxx",opaque="yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy"'
        ]);

        return new PhpAuthDigest;
    }
}
