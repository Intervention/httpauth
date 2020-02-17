<?php

namespace Intervention\Httpauth\Test;

use PHPUnit\Framework\TestCase;
use Intervention\Httpauth\AbstractCredentials;

class AbstractCredentialsTest extends TestCase
{
    public function testFill()
    {
        $credentials = $this->getMockForAbstractClass(AbstractCredentials::class);
        $result = $credentials->fill([
            'username' => 'foo',
            'password' => 'bar',
        ]);

        $this->assertInstanceOf(AbstractCredentials::class, $result);
        $this->assertEquals('foo', $credentials->get('username'));
        $this->assertEquals('bar', $credentials->get('password'));
    }

    public function testSetGet()
    {
        $credentials = $this->getMockForAbstractClass(AbstractCredentials::class);
        $this->assertNull($credentials->get('username'));
        $credentials->set('username', 'foo');
        $this->assertEquals('foo', $credentials->get('username'));
    }
}
