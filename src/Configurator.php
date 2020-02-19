<?php

namespace Intervention\HttpAuth;

use Intervention\HttpAuth\Vault\BasicVault;
use Intervention\HttpAuth\Vault\DigestVault;

class Configurator implements ConfiguratorInterface
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
        return $this;
    }

    public function type($value)
    {
        $this->type = $value;

        return $this;
    }

    public function realm($value)
    {
        $this->realm = $value;

        return $this;
    }

    public function username($value)
    {
        $this->username = $value;

        return $this;
    }

    public function password($value)
    {
        $this->password = $value;

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
}
