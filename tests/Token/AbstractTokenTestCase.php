<?php

namespace Intervention\HttpAuth\Test\Token;

use Intervention\HttpAuth\Directive;
use Intervention\HttpAuth\Environment;
use Intervention\HttpAuth\Key;
use PHPUnit\Framework\TestCase;

abstract class AbstractTokenTestCase extends TestCase
{
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
