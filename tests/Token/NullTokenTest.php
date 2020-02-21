<?php

namespace Intervention\HttpAuth\Test\Token;

use Intervention\HttpAuth\Token\NullToken;
use Intervention\HttpAuth\Key;
use PHPUnit\Framework\TestCase;

class NullTokenTest extends AbstractTokenTestCase
{
    public function testParse()
    {
        $auth = new NullToken;
        $this->assertInstanceOf(NullToken::class, $auth);
    }

    public function testToKey()
    {
        $auth = new NullToken;
        $this->assertInstanceOf(Key::class, $auth->toKey());
    }
}
