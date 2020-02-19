<?php

namespace Intervention\Httpauth;

class Environment
{
    public function getKeyValue(): ?string
    {
        switch (true) {
            case array_key_exists('PHP_AUTH_USER', $_SERVER):
                $username = $_SERVER['PHP_AUTH_USER'];
                $password = array_key_exists('PHP_AUTH_PW', $_SERVER) ? $_SERVER['PHP_AUTH_PW'] : null;
                return sprintf('basic_%s', base64_encode(implode(':', [
                    $username,
                    $password,
                ])));
            
            case array_key_exists('HTTP_AUTHENTICATION', $_SERVER):
                return $_SERVER['HTTP_AUTHENTICATION'];

            case array_key_exists('REDIRECT_HTTP_AUTHORIZATION', $_SERVER):
                return $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];

            case array_key_exists('PHP_AUTH_DIGEST', $_SERVER):
                return $_SERVER['PHP_AUTH_DIGEST'];

            case array_key_exists('HTTP_AUTHORIZATION', $_SERVER):
                return $_SERVER['HTTP_AUTHORIZATION'];

            default:
                return null;
        }
    }
}
