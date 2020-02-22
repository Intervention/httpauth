<?php

namespace Intervention\HttpAuth;

use Intervention\HttpAuth\Vault\BasicVault;
use Intervention\HttpAuth\Vault\DigestVault;

class HttpAuth
{
   /**
     * Authentication type
     *
     * @var string
     */
    protected $type = 'basic';

    /**
     * Name of authentication realm
     *
     * @var string
     */
    protected $realm = 'Secured Resource';

    /**
     * Username
     *
     * @var string
     */
    protected $username = 'admin';

    /**
     * Password
     *
     * @var string
     */
    protected $password = 'secret';

    /**
     * Create HTTP auth instance and configure via given array or callback
     *
     * @param  mixed $config
     * @return HttpAuth
     */
    public static function make($config = null): HttpAuth
    {
        $auth = new self;

        switch (true) {
            case is_array($config):
                $auth->configureByArray($config);
                break;
            
            case is_callable($config):
                $auth->configureByCallback($config);
                break;

            case is_null($config):
                // call without argument
                break;

            default:
                throw new Exception\NotSupportedException(
                    "Unable to create HTTP Auth from ".gettype($config)."."
                );
        }

        return $auth;
    }

    /**
     * Create vault by parameters and secure it
     *
     * @return void
     */
    public function secure(): void
    {
        $this->getVault()->secure();
    }

    /**
     * Create HTTP basic auth instance
     *
     * @return HttpAuth
     */
    public function basic(): HttpAuth
    {
        $this->type = 'basic';

        return $this;
    }

    /**
     * Create HTTP digest auth instance
     *
     * @return HttpAuth
     */
    public function digest(): HttpAuth
    {
        $this->type = 'digest';

        return $this;
    }

    /**
     * Set type of configured vault
     *
     * @param  string $value
     * @return HttpAuth
     */
    public function type($value)
    {
        $this->type = $value;

        return $this;
    }

    /**
     * Set realm name of configured vault
     *
     * @param  string $value
     * @return HttpAuth
     */
    public function realm($value)
    {
        $this->realm = $value;

        return $this;
    }

    /**
     * Set username of configured vault
     *
     * @param  string $value
     * @return HttpAuth
     */
    public function username($value)
    {
        $this->username = $value;

        return $this;
    }

    /**
     * Set password of configured vault
     *
     * @param  string $value
     * @return HttpAuth
     */
    public function password($value)
    {
        $this->password = $value;

        return $this;
    }

    /**
     * Set credentials for configured vault
     *
     * @param  string $username
     * @param  string $password
     * @return HttpAuth
     */
    public function credentials($username, $password)
    {
        return $this->username($username)->password($password);
    }

    /**
     * Get type of current instance
     *
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get realm of current instance
     *
     * @return mixed
     */
    public function getRealm()
    {
        return $this->realm;
    }

    /**
     * Get username of current instance
     *
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get password of current instance
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Configure instance with given config array
     *
     * @param  array $config
     * @return HttpAuth
     */
    protected function configureByArray(array $config): HttpAuth
    {
        foreach ($config as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }

        return $this;
    }

    /**
     * Configure by callback
     *
     * @param  callable $callback
     * @return HttpAuth
     */
    protected function configureByCallback($callback): HttpAuth
    {
        if (is_callable($callback)) {
            $callback($this);
        }

        return $this;
    }

    /**
     * Return ready configured vault
     *
     * @return AbstractVault
     */
    protected function getVault(): AbstractVault
    {
        switch (strtolower($this->type)) {
            case 'digest':
                return new DigestVault($this->realm, $this->username, $this->password);
            
            default:
                return new BasicVault($this->realm, $this->username, $this->password);
        }
    }
}
