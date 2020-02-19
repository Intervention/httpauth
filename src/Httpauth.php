<?php

namespace Intervention\HttpAuth;

class HttpAuth
{
    public static function make($config = null): AbstractVault
    {
        return $this->getConfigurator($config)->getVault();
    }

    private function getConfigurator($config)
    {
        switch (true) {
            case is_callable($config):
                return new CallbackConfigurator($config);

            case is_array($config):
                return new ArrayConfigurator($config);
            
            default:
                return new Configurator;
        }
    }
}
