<?php

namespace Intervention\HttpAuth;

use Intervention\HttpAuth\Vault\BasicVault;
use Intervention\HttpAuth\Vault\DigestVault;

class ArrayConfigurator extends Configurator
{
    public function configure($config): ConfiguratorInterface
    {
        foreach ($config as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }

        return $this;
    }
}
