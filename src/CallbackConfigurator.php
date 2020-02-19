<?php

namespace Intervention\HttpAuth;

use Intervention\HttpAuth\Vault\BasicVault;
use Intervention\HttpAuth\Vault\DigestVault;

class CallbackConfigurator extemds Configurator
{
    public function configure($config): ConfiguratorInterface
    {
        if (is_callable($config)) {
            $config($this);
        }

        return $this;
    }
}
