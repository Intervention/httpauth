<?php

namespace Intervention\HttpAuth;

class HttpAuth
{
    public static function make($config = null): AbstractVault
    {
        return $this->getConfigurator($config)->getVault();
    }

    private function getConfigurator($config): ConfiguratorInterface
    {
        switch (true) {
            case is_callable($config):
                return new Configurator\CallbackConfigurator($config);

            case is_array($config):
                return new Configurator\ArrayConfigurator($config);
            
            default:
                return new Configurator\Configurator;
        }
    }
}
