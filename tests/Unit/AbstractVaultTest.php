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
        $this->assertEquals('myUsername', $vault->getUsername());
        $this->assertEquals('myPassword', $vault->getPassword());
        $this->assertEquals('myRealm', $vault->getRealm());
    }

    public function testSetGetUsername(): void
    {
        $vault = $this->getTestVault('myRealm', 'myUsername', 'myPassword');
        $vault->withUsername('foo');
        $this->assertEquals('foo', $vault->getUsername());
    }

    public function testSetGetPassword(): void
    {
        $vault = $this->getTestVault('myRealm', 'myUsername', 'myPassword');
        $vault->withPassword('foo');
        $this->assertEquals('foo', $vault->getPassword());
    }

    public function testSetGetRealm(): void
    {
        $vault = $this->getTestVault('myRealm', 'myUsername', 'myPassword');
        $vault->withRealm('foo');
        $this->assertEquals('foo', $vault->getRealm());
    }
}
