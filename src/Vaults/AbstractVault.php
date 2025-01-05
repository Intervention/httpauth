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
     *
     * @param string $username
     * @param string $password
     * @param string $realm
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
     *
     * @param string $realm
     * @return AbstractVault
     */
    public function setRealm(string $realm): self
    {
        $this->realm = $realm;

        return $this;
    }

    /**
     * Return current realm name
     *
     * @return string
     */
    public function realm(): string
    {
        return $this->realm;
    }

    /**
     * Set username for current vault
     *
     * @param string $username
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Return current username
     *
     * @return string
     */
    public function username(): string
    {
        return $this->username;
    }

    /**
     * Set password for current vault
     *
     * @param string $password
     * @return AbstractVault
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Return current password
     *
     * @return string
     */
    public function password(): string
    {
        return $this->password;
    }

    /**
     * Set username and password at once
     *
     * @param string $username
     * @param string $password
     * @return AbstractVault
     */
    public function setCredentials(string $username, string $password): self
    {
        return $this->setUsername($username)->setPassword($password);
    }

    /**
     * Send HTTP 401 Header
     *
     * @return void
     */
    protected function denyAccess(?string $message = null): void
    {
        $protocol = $_SERVER['SERVER_PROTOCOL'] ?: 'HTTP/1.1';
        $message = empty($message) ? '<strong>' . $protocol . ' 401 Unauthorized</strong>' : $message;

        header($protocol . ' 401 Unauthorized');
        header('WWW-Authenticate: ' . $this->type()->value . ' ' . $this->directive());
        exit($message);
    }
}
