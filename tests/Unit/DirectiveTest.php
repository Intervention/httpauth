<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Tests\Unit;

use Intervention\HttpAuth\Directive;
use PHPUnit\Framework\TestCase;

final class DirectiveTest extends TestCase
{
    public function testConstructor(): void
    {
        $directive = new Directive();
        $this->assertInstanceOf(Directive::class, $directive);
    }

    public function testToString(): void
    {
        $directive = new Directive(['a' => 'foo', 'b' => 'bar', 'c' => 'baz']);
        $this->assertEquals('a="foo", b="bar", c="baz"', (string) $directive);
    }
}
