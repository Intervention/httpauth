<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Tests\Unit;

use Intervention\HttpAuth\Key;
use PHPUnit\Framework\TestCase;

final class KeyTest extends TestCase
{
    public function testSetGet(): void
    {
        $key = new Key();
        $this->assertNull($key->realm());
        $this->assertNull($key->username());
        $this->assertNull($key->password());
        $this->assertNull($key->getQop());
        $this->assertNull($key->getNonce());
        $this->assertNull($key->getOpaque());
        $this->assertNull($key->getUri());
        $this->assertNull($key->getNc());
        $this->assertNull($key->getCnonce());
        $this->assertNull($key->getResponse());

        $key->setProperty('realm', 'testRealm');
        $key->setProperty('username', 'testUsername');
        $key->setProperty('password', 'testPassword');
        $key->setProperty('qop', 'testQop');
        $key->setProperty('nonce', 'testNonce');
        $key->setProperty('opaque', 'testOpaque');
        $key->setProperty('uri', 'testUri');
        $key->setProperty('nc', 'testNc');
        $key->setProperty('cnonce', 'testCnonce');
        $key->setProperty('response', 'testResponse');

        $this->assertEquals('testRealm', $key->realm());
        $this->assertEquals('testUsername', $key->username());
        $this->assertEquals('testPassword', $key->password());
        $this->assertEquals('testQop', $key->getQop());
        $this->assertEquals('testNonce', $key->getNonce());
        $this->assertEquals('testOpaque', $key->getOpaque());
        $this->assertEquals('testUri', $key->getUri());
        $this->assertEquals('testNc', $key->getNc());
        $this->assertEquals('testCnonce', $key->getCnonce());
        $this->assertEquals('testResponse', $key->getResponse());
    }
}
