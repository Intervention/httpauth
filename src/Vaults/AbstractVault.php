<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Vaults;

use Intervention\HttpAuth\Environment;
use Intervention\HttpAuth\Exceptions\AuthentificationException;
use Intervention\HttpAuth\Interfaces\TokenInterface;
use Intervention\HttpAuth\Interfaces\VaultInterface;
use SensitiveParameter;

abstract class AbstractVault implements VaultInterface
{
    /**
     * Create new instance
     */
    public function __construct(
        #[SensitiveParameter] protected string $username,
        #[SensitiveParameter] protected string $password,
        protected string $realm = 'Secured Area',
    ) {
    }

    /**
     * {@inheritdoc}
     *
     * @see VaultInterface::verify()
     */
    public function verify(TokenInterface $token): void
    {
        throw new AuthentificationException();
    }

    /**
     * {@inheritdoc}
     *
     * @see VaultInterface::secure()
     */
    public function secure(?string $message = null): void
    {
        try {
            $this->verify(Environment::token());
        } catch (AuthentificationException) {
            $this->denyAccess($message);
        }
    }

    /**
     * Set name of realm
     */
    public function setRealm(string $realm): self
    {
        $this->realm = $realm;

        return $this;
    }

    /**
     * Return current realm name
     */
    public function realm(): string
    {
        return $this->realm;
    }

    /**
     * Set username for current vault
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Return current username
     */
    public function username(): string
    {
        return $this->username;
    }

    /**
     * Set password for current vault
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Return current password
     */
    public function password(): string
    {
        return $this->password;
    }

    /**
     * Set username and password at once
     */
    public function setCredentials(string $username, string $password): self
    {
        return $this->setUsername($username)->setPassword($password);
    }

    /**
     * Send HTTP 401 Header
     */
    protected function denyAccess(?string $message = null): void
    {
        $protocol = $_SERVER['SERVER_PROTOCOL'] ?: 'HTTP/1.1';
        $message = $message === null ? '<strong>' . $protocol . ' 401 Unauthorized</strong>' : $message;

        header($protocol . ' 401 Unauthorized');
        header('WWW-Authenticate: ' . $this->type()->value . ' ' . $this->directive());
        exit($message);
    }
}
