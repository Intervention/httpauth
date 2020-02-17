<?php

namespace Intervention\Httpauth\Test\Digest;

use Intervention\Httpauth\Digest\Credentials;
use PHPUnit\Framework\TestCase;

class CredentialsTest extends TestCase
{
    public function testMatches()
    {
        $credentials1 = new Credentials([
            'username' => 'foo',
            'password' => 'bar'
        ]);
        
        $credentials2 = new Credentials([
            'username' => 'foo',
            'password' => 'bar'
        ]);
        
        $credentials3 = new Credentials([
            'username' => 'foo',
            'password' => 'baz'
        ]);
        
        $this->assertTrue($credentials1->matches($credentials1));
        $this->assertTrue($credentials1->matches($credentials2));
        $this->assertFalse($credentials1->matches($credentials3));
        
        $this->assertTrue($credentials2->matches($credentials2));
        $this->assertTrue($credentials2->matches($credentials1));
        $this->assertFalse($credentials2->matches($credentials3));

        $this->assertTrue($credentials3->matches($credentials3));
        $this->assertFalse($credentials3->matches($credentials1));
        $this->assertFalse($credentials3->matches($credentials2));
    }
}
