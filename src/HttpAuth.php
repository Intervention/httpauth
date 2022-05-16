<?php

namespace Intervention\HttpAuth;

class HttpAuth
{
    public function __construct(
        protected string $type = 'basic',
        protected string $realm = 'Secure realm',
        protected string $username = 'admin',
        protected string $password = 'secret'
    ) {
        //
    }

    /**
     * Create HTTP basic auth instance
     *
     * @return HttpAuth
     */
    public static function basic(string $realm = 'Secure realm'): self
    {
        return new self('basic', $realm);
    }

    /**
     * Create HTTP digest auth instance
     *
     * @return HttpAuth
     */
    public static function digest(string $realm = 'Secure realm'): self
    {
        return new self('digest', $realm);
    }

    /**
     * Create vault by current parameters and secure it
     *
     * @return void
     */
    public function secure(): void
    {
        $this->getVault()->secure();
    }

    /**
     * Set type of vault to configure
     *
     * @param  string $type
     * @return self
     */
    public function withType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Set realm name of configured vault
     *
     * @param  string $password
     * @return HttpAuth
     */
    public function withRealm(string $realm): self
    {
        $this->realm = $realm;

        return $this;
    }

    /**
     * Set username of configured vault
     *
     * @param  string $password
     * @return HttpAuth
     */
    public function withUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set password of configured vault
     *
     * @param  string $password
     * @return HttpAuth
     */
    public function withPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set credentials for configured vault
     *
     * @param  string $username
     * @param  string $password
     * @return HttpAuth
     */
    public function withCredentials(string $username, string $password): self
    {
        return $this->withUsername($username)->withPassword($password);
    }

    /**
     * Get type of current instance
     *
     * @return mixed
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Get realm of current instance
     *
     * @return mixed
     */
    public function getRealm(): string
    {
        return $this->realm;
    }

    /**
     * Get username of current instance
     *
     * @return mixed
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Get password of current instance
     *
     * @return mixed
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Return ready configured vault
     *
     * @return AbstractVault
     */
    protected function getVault(): AbstractVault
    {
        $classname = sprintf('%s\Vault\%sVault', __NAMESPACE__, ucfirst(strtolower($this->type)));

        if (!class_exists($classname)) {
            throw new Exception\NotSupportedException(
                'Unable to create HTTP authentication vault of type "' . $this->type . '".'
            );
        }

        return new $classname(
            $this->realm,
            $this->username,
            $this->password
        );
    }
}
