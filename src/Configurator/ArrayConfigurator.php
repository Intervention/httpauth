<?php

namespace Intervention\HttpAuth\Configurator;

use Intervention\HttpAuth\AbstractVault;
use Intervention\HttpAuth\ConfiguratorInterface;
use Intervention\HttpAuth\Vault\BasicVault;
use Intervention\HttpAuth\Vault\DigestVault;

class ArrayConfigurator implements ConfiguratorInterface
{
    protected $type = 'basic';
    protected $realm = 'Secured Resource';
    protected $username = 'admin';
    protected $password = 'secret';

    public function __construct($config = null)
    {
        $this->configure($config);
    }

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

    public function getVault(): AbstractVault
    {
        switch (strtolower($this->type)) {
            case 'digest':
                return new DigestVault($this->realm, $this->username, $this->password);
            
            default:
                return new BasicVault($this->realm, $this->username, $this->password);
        }
    }

    public function type($value)
    {
        $this->type = $value;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function realm($value)
    {
        $this->realm = $value;

        return $this;
    }

    public function getRealm()
    {
        return $this->realm;
    }

    public function username($value)
    {
        $this->username = $value;

        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function password($value)
    {
        $this->password = $value;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }
}
