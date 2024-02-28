<?php

namespace Intervention\HttpAuth\Test\Unit\Token;

use Intervention\HttpAuth\Test\AbstractTokenTestCase;
use Intervention\HttpAuth\Token\AbstractToken;
use Intervention\HttpAuth\Key;

final class AbstractTokenTest extends AbstractTokenTestCase
{
    public function testGetKey(): void
    {
        $token = $this->getMockForAbstractClass(AbstractToken::class);
        $key = $token->getKey();
        $this->assertInstanceOf(Key::class, $key);
    }
}
