<?php

namespace Intervention\HttpAuth;

use Intervention\HttpAuth\Configurator\ArrayConfigurator;

abstract class AbstractVault
{
    /**
     * Environment
     *
     * @var Environment
     */
    protected $environment;

    /**
     * Name of realm for vault
     *
     * @var string
     */
    protected $realm;

    /**
     * Username for vault
     * @var string
     */
    protected $username;

    /**
     * Password for vault
     *
     * @var string
     */
    protected $password;

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
    public function __construct($realm, $username, $password)
    {
        $this->checkParameterValidity([
            'realm' => $realm,
            'username' => $username,
            'password' => $password,
        ]);

        $this->environment = new Environment;

        $this->realm = $realm;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Throw exception if any of the given parameters are empty
     *
     * @param  array $parameters
     * @return void
     */
    private function checkParameterValidity(array $parameters): void
    {
        foreach ($parameters as $key => $value) {
            if (empty($value)) {
                throw new Exception\InvalidParameterException(
                    'Cannot create HTTP authentication vault. Parameter "'.$key.'" cannot be empty.'
                );
            }
        }
    }

    /**
     * Return key from current token
     *
     * @return Key
     */
    public function getKey(): Key
    {
        return $this->environment->getToken()->toKey();
    }

    /**
     * Denies access for non-authenticated users
     *
     * @return void
     */
    public function secure(): void
    {
        if (! $this->unlocksWithKey($this->getKey())) {
            $this->denyAccess();
        }
    }

    /**
     * Set name of realm
     *
     * @param string $realm
     * @return AbstractVault
     */
    public function setRealm($realm): AbstractVault
    {
        $this->realm = $realm;

        return $this;
    }

    /**
     * Alias for setRealm()
     *
     * @param string $realm
     * @return AbstractVault
     */
    public function realm($realm): AbstractVault
    {
        return $this->setRealm($realm);
    }

    /**
     * Return current realm name
     *
     * @return string
     */
    public function getRealm()
    {
        return $this->realm;
    }

    /**
     * Set username for current vault
     *
     * @param string $username
     */
    public function setUsername($username): AbstractVault
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Alias for setUsername()
     *
     * @param string $username
     */
    public function username($username): AbstractVault
    {
        return $this->setUsername($username);
    }

    /**
     * Return current username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password for current vault
     *
     * @param string $password
     * @return AbstractVault
     */
    public function setPassword($password): AbstractVault
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Alias for setPassword()
     *
     * @param  string $password
     * @return AbstractVault
     */
    public function password($password): AbstractVault
    {
        return $this->setPassword($password);
    }

    /**
     * Return current password
     *
     * @return string
     */
    public function getPassword()
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
    public function credentials($username, $password): AbstractVault
    {
        return $this->setUsername($username)->setPassword($password);
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
        exit('<strong>'.$protocol.' 401 Unauthorized</strong>');
    }
}
