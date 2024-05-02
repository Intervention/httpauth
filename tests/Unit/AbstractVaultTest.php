<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Tests\Unit;

use Intervention\HttpAuth\AbstractVault;
use Intervention\HttpAuth\Directive;
use Intervention\HttpAuth\Key;
use PHPUnit\Framework\TestCase;

final class AbstractVaultTest extends TestCase
{
    private function getTestVault(string $realm, string $username, string $password): AbstractVault
    {
        return new class ($realm, $username, $password) extends AbstractVault
        {
            public function getDirective(): Directive
            {
                return new Directive('test');
            }

            public function unlocksWithKey(Key $key): bool
            {
                return false;
            }
        };
    }

    public function testConstructor(): void
    {
        $vault = $this->getTestVault('myRealm', 'myUsername', 'myPassword');
        $this->assertEquals('myUsername', $vault->username());
        $this->assertEquals('myPassword', $vault->password());
        $this->assertEquals('myRealm', $vault->realm());
    }

    public function testSetGetUsername(): void
    {
        $vault = $this->getTestVault('myRealm', 'myUsername', 'myPassword');
        $vault->setUsername('foo');
        $this->assertEquals('foo', $vault->username());
    }

    public function testSetGetPassword(): void
    {
        $vault = $this->getTestVault('myRealm', 'myUsername', 'myPassword');
        $vault->setPassword('foo');
        $this->assertEquals('foo', $vault->password());
    }

    public function testSetGetRealm(): void
    {
        $vault = $this->getTestVault('myRealm', 'myUsername', 'myPassword');
        $vault->setRealm('foo');
        $this->assertEquals('foo', $vault->realm());
    }
}
