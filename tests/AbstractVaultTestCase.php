<?php

namespace Intervention\Httpauth\Test;

use Intervention\Httpauth\Directive;
use Intervention\Httpauth\Environment;
use PHPUnit\Framework\TestCase;

abstract class AbstractVaultTestCase extends TestCase
{
    protected function getKeyValue()
    {
        $environment = new Environment;
        return $environment->getKeyValue();
    }

    protected function setServerVars($values = [])
    {
        unset($_SERVER['PHP_AUTH_DIGEST']);
        unset($_SERVER['HTTP_AUTHORIZATION']);
        unset($_SERVER['PHP_AUTH_USER']);
        unset($_SERVER['PHP_AUTH_PW']);
        unset($_SERVER['HTTP_AUTHENTICATION']);
        unset($_SERVER['REDIRECT_HTTP_AUTHORIZATION']);

        foreach ($values as $key => $value) {
            $_SERVER[$key] = $value;
        }
    }
}
