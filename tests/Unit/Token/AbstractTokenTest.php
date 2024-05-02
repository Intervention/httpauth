<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Tests\Unit\Token;

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
