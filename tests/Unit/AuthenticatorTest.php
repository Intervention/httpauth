<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Tests\Unit;

use Intervention\HttpAuth\Authenticator;
use Intervention\HttpAuth\Vault\BasicVault;
use PHPUnit\Framework\TestCase;

final class AuthenticatorTest extends TestCase
{
    public function testConstructor(): void
    {
        $auth = new Authenticator(new BasicVault('myUsername', 'myPassword'));
        $this->assertInstanceOf(Authenticator::class, $auth);
    }

    public function testWithVault(): void
    {
        $auth = Authenticator::withVault(new BasicVault('myUsername', 'myPassword'));
        $this->assertInstanceOf(Authenticator::class, $auth);
    }

    public function testBasic(): void
    {
        $auth = Authenticator::basic('myUsername', 'myPassword', 'myRealm');
        $this->assertInstanceOf(Authenticator::class, $auth);
    }

    public function testDigest(): void
    {
        $auth = Authenticator::digest('myUsername', 'myPassword', 'myRealm');
        $this->assertInstanceOf(Authenticator::class, $auth);
    }
}
