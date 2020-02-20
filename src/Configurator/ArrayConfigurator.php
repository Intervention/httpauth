<?php

namespace Intervention\HttpAuth\Configurator;

use Intervention\HttpAuth\AbstractVault;
use Intervention\HttpAuth\ConfiguratorInterface;
use Intervention\HttpAuth\Vault\BasicVault;
use Intervention\HttpAuth\Vault\DigestVault;

class ArrayConfigurator implements ConfiguratorInterface
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
     * Create new instance
     *
     * @param ArrayConfigurator $config
     */
    public function __construct($config = null)
    {
        $this->configure($config);
    }

    /**
     * Configure instance with given config
     *
     * @param  mixed $config
     * @return ConfiguratorInterface
     */
    public function configure($config): ConfiguratorInterface
    {
        if (is_array($config)) {
            foreach ($config as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->{$key} = $value;
                }
            }
        }

        return $this;
    }

    /**
     * Return ready configured vault
     *
     * @return AbstractVault
     */
    public function getVault(): AbstractVault
    {
        switch (strtolower($this->type)) {
            case 'digest':
                return new DigestVault($this->realm, $this->username, $this->password);
            
            default:
                return new BasicVault($this->realm, $this->username, $this->password);
        }
    }

    /**
     * Set type of configured vault
     *
     * @param  string $value
     * @return ArrayConfigurator
     */
    public function type($value)
    {
        $this->type = $value;

        return $this;
    }

    /**
     * Get type of configured vault
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set realm name of configured vault
     *
     * @param  string $value
     * @return ArrayConfigurator
     */
    public function realm($value)
    {
        $this->realm = $value;

        return $this;
    }

    /**
     * Get realm of configured vault
     *
     * @return string
     */
    public function getRealm()
    {
        return $this->realm;
    }

    /**
     * Set username of configured vault
     *
     * @param  string $value
     * @return ArrayConfigurator
     */
    public function username($value)
    {
        $this->username = $value;

        return $this;
    }

    /**
     * Get username of configured vault
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password of configured vault
     *
     * @param  string $value
     * @return ArrayConfigurator
     */
    public function password($value)
    {
        $this->password = $value;

        return $this;
    }

    /**
     * Get password of configured vault
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set credentials for configured vault
     *
     * @param  string $username
     * @param  string $password
     * @return ArrayConfigurator
     */
    public function credentials($username, $password)
    {
        return $this->username($username)->password($password);
    }
}
