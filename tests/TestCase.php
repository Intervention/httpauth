<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Tests;

use PHPUnit\Framework\TestCase as PhpUnitTestcase;

abstract class TestCase extends PhpUnitTestcase
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
