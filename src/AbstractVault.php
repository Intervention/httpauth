<?php

namespace Intervention\Httpauth;

abstract class AbstractVault
{
    protected $environment;
    protected $realm;
    protected $username;
    protected $password;

    abstract public function getDirective(): Directive;
    abstract public function unlocksWithKey(Key $key): bool;

    public function __construct($realm, $username, $password)
    {
        $this->environment = new Environment;

        $this->realm = $realm;
        $this->username = $username;
        $this->password = $password;
    }

    public function getKey(): Key
    {
        return $this->environment->getToken()->toKey();
    }

    /**
     * Denies access for non-authenticated users
     *
     * @return void
     */
    public function lock(): void
    {
        if (! $this->unlocksWithKey($this->getKey())) {
            $this->denyAccess();
        }
    }

    public function setRealm($realm): AbstractVault
    {
        $this->realm = $realm;

        return $this;
    }

    public function getRealm()
    {
        return $this->realm;
    }

    public function setUsername($username): AbstractVault
    {
        $this->username = $username;

        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setPassword($password): AbstractVault
    {
        $this->password = $password;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sends HTTP 401 Header
     *
     * @return void
     */
    protected function denyAccess(): void
    {
        header($_SERVER['SERVER_PROTOCOL'] . ' Unauthorized');
        header('WWW-Authenticate: ' . (string) $this->getDirective());
        exit('<strong>'.$_SERVER['SERVER_PROTOCOL'].' 401 Unauthorized</strong>');
    }
}
