<?php

namespace Intervention\Httpauth;

class Httpauth
{
    /**
     * Create new basic auth and configure optionally by callback
     *
     * @param  callable $callback
     * @return Basic\Vault
     */
    public static function basic($callback = null): Basic\Vault
    {
        return self::createVaultByClassname(Basic\Vault::class, $callback);
    }

    /**
     * Create new digest auth and configure optionally by callback
     *
     * @param  callable $callback
     * @return Digest\Vault
     */
    public static function digest($callback = null): Digest\Vault
    {
        return self::createVaultByClassname(Digest\Vault::class, $callback);
    }

    /**
     * Create new vault by classname and configure optionally by callback
     *
     * @param  string   $classname
     * @param  callable $callback
     * @return AbstractVault
     */
    public static function createVaultByClassname($classname, $callback = null): AbstractVault
    {
        $vault = new $classname;
        
        if (is_callable($callback)) {
            $callback($vault);
        }

        return $vault;
    }
}
