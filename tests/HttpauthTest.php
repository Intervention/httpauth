<?php

namespace Intervention\Httpauth\Test;

use PHPUnit\Framework\TestCase;
use Intervention\Httpauth\Httpauth;
use Intervention\Httpauth\Basic\Vault as BasicVault;
use Intervention\Httpauth\Basic\Credentials as BasicCredentials;
use Intervention\Httpauth\Digest\Vault as DigestVault;
use Intervention\Httpauth\Digest\Credentials as DigestCredentials;

class HttpauthTest extends TestCase
{
    public function testBasic()
    {
        $result = Httpauth::basic();
        $this->assertInstanceOf(BasicVault::class, $result);
        $this->assertInstanceOf(BasicCredentials::class, $result->getCredentials());
    }

    public function testDigest()
    {
        $result = Httpauth::digest();
        $this->assertInstanceOf(DigestVault::class, $result);
        $this->assertInstanceOf(DigestCredentials::class, $result->getCredentials());
    }

    public function testBasicWithCallback()
    {
        $result = Httpauth::basic(function ($vault) {
            $vault->setUsername('foo');
            $vault->setPassword('bar');
            $vault->setName('baz');
        });

        $this->assertEquals('foo', $result->getCredentials()->get('username'));
        $this->assertEquals('bar', $result->getCredentials()->get('password'));
        $this->assertEquals('baz', $result->getName());
    }

    public function testDigestWithCallback()
    {
        $result = Httpauth::digest(function ($vault) {
            $vault->setUsername('foo');
            $vault->setPassword('bar');
            $vault->setName('baz');
        });

        $this->assertEquals('foo', $result->getCredentials()->get('username'));
        $this->assertEquals('bar', $result->getCredentials()->get('password'));
        $this->assertEquals('baz', $result->getName());
    }
}
