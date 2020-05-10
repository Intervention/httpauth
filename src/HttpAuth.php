<?php

namespace Intervention\HttpAuth;

class HttpAuth
{
   /**
     * Authentication type
     *
     * @var string
     */
    protected static $type = 'basic';

    /**
     * Name of authentication realm
     *
     * @var string
     */
    protected static $realm = 'Secured Resource';

    /**
     * Username
     *
     * @var string
     */
    protected static $username = 'admin';

    /**
     * Password
     *
     * @var string
     */
    protected static $password = 'secret';

    /**
     * Static factory method
     *
     * @param  array  $config
     * @return HttpAuth
     */
    public static function make(array $config = []): HttpAuth
    {
        return (new self())->configure($config);
    }

    /**
     * Configure current instance by array
     *
     * @param  array  $config
     * @return HttpAuth
     */
    private function configure(array $config = []): HttpAuth
    {
        foreach ($config as $key => $value) {
            if (isset(static::${$key})) {
                static::${$key} = $value;
            }
        }

        return $this;
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
     * Create HTTP basic auth instance
     *
     * @return HttpAuth
     */
    public function basic(): HttpAuth
    {
        static::$type = 'basic';

        return $this;
    }

    /**
     * Create HTTP digest auth instance
     *
     * @return HttpAuth
     */
    public function digest(): HttpAuth
    {
        static::$type = 'digest';

        return $this;
    }

    /**
     * Set type of configured vault
     *
     * @param  string $value
     * @return HttpAuth
     */
    public function type($value): HttpAuth
    {
        static::$type = $value;

        return $this;
    }

    /**
     * Set realm name of configured vault
     *
     * @param  string $value
     * @return HttpAuth
     */
    public function realm($value): HttpAuth
    {
        static::$realm = $value;

        return $this;
    }

    /**
     * Set username of configured vault
     *
     * @param  string $value
     * @return HttpAuth
     */
    public function username($value): HttpAuth
    {
        static::$username = $value;

        return $this;
    }

    /**
     * Set password of configured vault
     *
     * @param  string $value
     * @return HttpAuth
     */
    public function password($value): HttpAuth
    {
        static::$password = $value;

        return $this;
    }

    /**
     * Set credentials for configured vault
     *
     * @param  string $username
     * @param  string $password
     * @return HttpAuth
     */
    public function credentials($username, $password): HttpAuth
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
        return static::$type;
    }

    /**
     * Get realm of current instance
     *
     * @return mixed
     */
    public function getRealm()
    {
        return static::$realm;
    }

    /**
     * Get username of current instance
     *
     * @return mixed
     */
    public function getUsername()
    {
        return static::$username;
    }

    /**
     * Get password of current instance
     *
     * @return mixed
     */
    public function getPassword()
    {
        return static::$password;
    }

    /**
     * Return ready configured vault
     *
     * @return AbstractVault
     */
    protected function getVault(): AbstractVault
    {
        $classname = sprintf('%s\Vault\%sVault', __NAMESPACE__, ucfirst(strtolower(static::$type)));
        
        if (! class_exists($classname)) {
            throw new Exception\NotSupportedException(
                'Unable to create HTTP authentication vault of type "' . static::$type . '".'
            );
        }

        return new $classname(static::$realm, static::$username, static::$password);
    }
}
