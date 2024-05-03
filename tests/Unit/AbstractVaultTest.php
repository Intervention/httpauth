<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Tests\Unit;

use Intervention\HttpAuth\Directive;
use Intervention\HttpAuth\Interfaces\TokenInterface;
use Intervention\HttpAuth\Type;
use Intervention\HttpAuth\Vaults\AbstractVault;
use PHPUnit\Framework\TestCase;

final class AbstractVaultTest extends TestCase
{
    private function getTestVault(string $username, string $password, string $realm): AbstractVault
    {
        return new class ($username, $password, $realm) extends AbstractVault
        {
            public function directive(): Directive
            {
                return new Directive();
            }

            public function type(): Type
            {
                return Type::BASIC;
            }

            public function verify(TokenInterface $token): void
            {
            }
        };
    }

    public function testConstructor(): void
    {
        $vault = $this->getTestVault('myUsername', 'myPassword', 'myRealm');
        $this->assertEquals('myUsername', $vault->username());
        $this->assertEquals('myPassword', $vault->password());
        $this->assertEquals('myRealm', $vault->realm());
    }

    public function testSetGetUsername(): void
    {
        $vault = $this->getTestVault('myUsername', 'myPassword', 'myRealm');
        $vault->setUsername('foo');
        $this->assertEquals('foo', $vault->username());
    }

    public function testSetGetPassword(): void
    {
        $vault = $this->getTestVault('myUsername', 'myPassword', 'myRealm');
        $vault->setPassword('foo');
        $this->assertEquals('foo', $vault->password());
    }

    public function testSetGetRealm(): void
    {
        $vault = $this->getTestVault('myUsername', 'myPassword', 'myRealm');
        $vault->setRealm('foo');
        $this->assertEquals('foo', $vault->realm());
    }
}
