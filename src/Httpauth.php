<?php

namespace Intervention\HttpAuth;

use Intervention\Singleton\Singleton;

class HttpAuth extends Singleton
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
     * Return ready configured vault
     *
     * @return AbstractVault
     */
    protected function getVault(): AbstractVault
    {
        $classname = sprintf('%s\Vault\%sVault', __NAMESPACE__, ucfirst(strtolower($this->type)));
        
        if (! class_exists($classname)) {
            throw new Exception\NotSupportedException(
                'Unable to create HTTP authentication vault of type "'.$this->type.'".'
            );
        }

        return new $classname($this->realm, $this->username, $this->password);
    }
}
