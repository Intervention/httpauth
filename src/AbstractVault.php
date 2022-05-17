<?php

namespace Intervention\HttpAuth;

abstract class AbstractVault
{
    /**
     * Build directive for current vault
     *
     * @return Directive
     */
    abstract public function getDirective(): Directive;

    /**
     * Determine if vault is accessible by given key
     *
     * @param  Key    $key
     * @return bool
     */
    abstract public function unlocksWithKey(Key $key): bool;

    /**
     * Create new instance
     *
     * @param mixed $realm
     * @param mixed $username
     * @param mixed $password
     */
    public function __construct(
        protected string $realm,
        protected string $username,
        protected string $password
    ) {
        $this->realm = $realm;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Return key from current token
     *
     * @return Key
     */
    private function getKey(): Key
    {
        return (new Environment())->getToken()->toKey();
    }

    /**
     * Denies access for non-authenticated users
     *
     * @return void
     */
    public function secure(): void
    {
        if (!$this->unlocksWithKey($this->getKey())) {
            $this->denyAccess();
        }
    }

    /**
     * Set name of realm
     *
     * @param string $realm
     * @return AbstractVault
     */
    public function withRealm(string $realm): self
    {
        $this->realm = $realm;

        return $this;
    }

    /**
     * Return current realm name
     *
     * @return string
     */
    public function getRealm(): string
    {
        return $this->realm;
    }

    /**
     * Set username for current vault
     *
     * @param string $username
     */
    public function withUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Return current username
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Set password for current vault
     *
     * @param string $password
     * @return AbstractVault
     */
    public function withPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Return current password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set username and password at once
     *
     * @param  string $username
     * @param  string $password
     * @return AbstractVault
     */
    public function withCredentials(string $username, string $password): self
    {
        return $this->withUsername($username)->withPassword($password);
    }

    /**
     * Sends HTTP 401 Header
     *
     * @return void
     */
    protected function denyAccess(): void
    {
        $protocol = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.1';
        header($protocol . ' Unauthorized');
        header('WWW-Authenticate: ' . (string) $this->getDirective());
        exit('<strong>' . $protocol . ' 401 Unauthorized</strong>');
    }
}
