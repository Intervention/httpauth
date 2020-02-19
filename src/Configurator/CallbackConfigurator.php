<?php

namespace Intervention\HttpAuth\Configurator;

use Intervention\HttpAuth\ConfiguratorInterface;
use Intervention\HttpAuth\Vault\BasicVault;
use Intervention\HttpAuth\Vault\DigestVault;

class CallbackConfigurator extends ArrayConfigurator
{
    public function configure($config): ConfiguratorInterface
    {
        if (is_callable($config)) {
            $config($this);
        }

        return $this;
    }
}
