<?php

namespace Intervention\Httpauth\Test\Token;

use Intervention\Httpauth\Token\NullToken;
use Intervention\Httpauth\Key;
use PHPUnit\Framework\TestCase;

class NullAuthTest extends AbstractTokenTestCase
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
