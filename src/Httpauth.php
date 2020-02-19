<?php

namespace Intervention\HttpAuth;

class HttpAuth
{
    public static function make($config = null): AbstractVault
    {
        return self::getConfigurator($config)->getVault();
    }

    public static function basic(): AbstractVault
    {
        return self::make(['type' => 'basic']);
    }

    public static function digest(): AbstractVault
    {
        return self::make(['type' => 'digest']);
    }

    public static function __callStatic($name, $arguments): AbstractVault
    {
        $argument = isset($arguments[0]) ? $arguments[0] : null;

        return self::make([$name => $argument]);
    }

    private static function getConfigurator($config): ConfiguratorInterface
    {
        switch (true) {
            case is_callable($config):
                return new Configurator\CallbackConfigurator($config);

            case is_array($config):
                return new Configurator\ArrayConfigurator($config);
            
            default:
                return new Configurator\ArrayConfigurator;
        }
    }
}
