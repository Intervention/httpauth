<?php

declare(strict_types=1);

namespace Intervention\HttpAuth;

use Intervention\HttpAuth\Exceptions\NotSupportedException;
use Intervention\HttpAuth\Interfaces\VaultInterface;
use Intervention\HttpAuth\Vaults\BasicVault;
use Intervention\HttpAuth\Vaults\DigestVault;

class Authenticator
{
    /**
     * Create new instance
     */
    public function __construct(protected VaultInterface $vault)
    {
    }

    /**
     * Create HTTP basic auth instance
     */
    public static function basic(string $username, string $password, string $realm = 'Secured Area'): self
    {
        return new self(new BasicVault($username, $password, $realm));
    }

    /**
     * Create HTTP digest auth instance
     */
    public static function digest(string $username, string $password, string $realm = 'Secured Area'): self
    {
        return new self(new DigestVault($username, $password, $realm));
    }

    /**
     * Create auth instance
     */
    public static function withVault(VaultInterface $vault): self
    {
        return new self($vault);
    }

    /**
     * Create vault by current parameters and secure it
     *
     * @throws NotSupportedException
     */
    public function secure(?string $message = null): void
    {
        $this->vault->secure($message);
    }
}
