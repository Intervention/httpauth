<?php

namespace Intervention\Httpauth;

abstract class AbstractVault
{
    /**
     * Authentication types
     */
    const AUTH_TYPE_NONE = 0;
    const AUTH_TYPE_AUTH_USER = 1;
    const AUTH_TYPE_AUTHENTICATION = 2;
    const AUTH_TYPE_REDIRECT = 3;
    const AUTH_TYPE_AUTH_DIGEST = 4;
    const AUTH_TYPE_AUTHORIZATION = 5;

    /**
     * Name of secured resource
     *
     * @var string
     */
    protected $name;

    /**
     * Credentials to access secured resource
     *
     * @var AbstractCredentials
     */
    protected $credentials;

    /**
     * Return auth value from environment information
     *
     * @return string
     */
    abstract protected function getAuthValue(): ?string;

    /**
     * Decode given auth value to Credentials object
     *
     * @param  string $value
     * @return AbstractCredentials
     */
    abstract protected function decodeAuthValue($value): AbstractCredentials;

    /**
     * Build auth directive from current object
     *
     * @return string
     */
    abstract public function getDirective(): string;

    /**
     * Return authenticated user credentials from current request
     *
     * @return AbstractCredentials
     */
    public function getAuth(): AbstractCredentials
    {
        return $this->decodeAuthValue(
            $this->getAuthValue()
        );
    }

    /**
     * Return current credentials
     *
     * @return AbstractCredentials
     */
    public function getCredentials(): AbstractCredentials
    {
        return $this->credentials;
    }

    /**
     * Set credentials to secure resource
     *
     * @param AbstractCredentials $credentials
     * @return AbstractVault
     */
    public function setCredentials(AbstractCredentials $credentials): AbstractVault
    {
        $this->credentials = $credentials;

        return $this;
    }

    /**
     * Return name of current secure resource
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name of current secure resource
     *
     * @return string
     * @return AbstractVault
     */
    public function setName($name): AbstractVault
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set username on current credentials of vault
     *
     * @param string $username
     */
    public function setUsername($username): AbstractVault
    {
        $this->credentials->set('username', $username);

        return $this;
    }

    /**
     * Set password in current credentials of vault
     *
     * @param string $password
     */
    public function setPassword($password): AbstractVault
    {
        $this->credentials->set('password', $password);
        
        return $this;
    }

    /**
     * Denies access for non-authenticated users
     *
     * @return void
     */
    public function secure(): void
    {
        if (! $this->getAuth()->matches($this->getCredentials())) {
            $this->denyAccess();
        }
    }

    /**
     * Sends HTTP 401 Header
     *
     * @return void
     */
    protected function denyAccess(): void
    {
        header($_SERVER['SERVER_PROTOCOL'] . ' Unauthorized');
        header('WWW-Authenticate: ' . $this->getDirective());
        exit('<strong>'.$_SERVER['SERVER_PROTOCOL'].' 401 Unauthorized</strong>');
    }

    /**
     * Read and return auth type defined in environment variables
     *
     * @return int
     */
    protected function getAuthType(): int
    {
        switch (true) {
            case array_key_exists('PHP_AUTH_USER', $_SERVER):
                return self::AUTH_TYPE_AUTH_USER;
            
            case array_key_exists('HTTP_AUTHENTICATION', $_SERVER):
                return self::AUTH_TYPE_AUTHENTICATION;

            case array_key_exists('REDIRECT_HTTP_AUTHORIZATION', $_SERVER):
                return self::AUTH_TYPE_REDIRECT;

            case array_key_exists('PHP_AUTH_DIGEST', $_SERVER):
                return self::AUTH_TYPE_AUTH_DIGEST;

            case array_key_exists('HTTP_AUTHORIZATION', $_SERVER):
                return self::AUTH_TYPE_AUTHORIZATION;

            default:
                return self::AUTH_TYPE_NONE;
        }
    }
}
