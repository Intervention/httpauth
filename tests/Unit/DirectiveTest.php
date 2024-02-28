<?php

namespace Intervention\HttpAuth\Test\Unit;

use Intervention\HttpAuth\Directive;
use PHPUnit\Framework\TestCase;

final class DirectiveTest extends TestCase
{
    public function testConstructor(): void
    {
        $directive = new Directive('foo');
        $this->assertInstanceOf(Directive::class, $directive);
    }

    public function testFormat(): void
    {
        $directive = new Directive('test', ['a' => 'foo', 'b' => 'bar', 'c' => 'baz']);
        $this->assertEquals('Test a="foo", b="bar", c="baz"', $directive->format());
    }

    public function testToString(): void
    {
        $directive = new Directive('test', ['a' => 'foo', 'b' => 'bar', 'c' => 'baz']);
        $directive = (string) $directive;
        $this->assertEquals('Test a="foo", b="bar", c="baz"', $directive);
    }
}
