<?php

namespace Intervention\Httpauth\Test;

use Intervention\Httpauth\Directive;
use PHPUnit\Framework\TestCase;

class DirectiveTest extends TestCase
{
    public function testConstructor()
    {
        $directive = new Directive('foo');
        $this->assertInstanceOf(Directive::class, $directive);
    }

    public function testFormat()
    {
        $directive = new Directive('test', ['a' => 'foo', 'b' => 'bar', 'c' => 'baz']);
        $this->assertEquals('Test a="foo", b="bar", c="baz"', $directive->format());
    }

    public function testToString()
    {
        $directive = new Directive('test', ['a' => 'foo', 'b' => 'bar', 'c' => 'baz']);
        $directive = (string) $directive;
        $this->assertEquals('Test a="foo", b="bar", c="baz"', $directive);
    }
}
