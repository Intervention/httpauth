<?php

namespace Intervention\Httpauth\Basic;

use Intervention\Httpauth\AbstractCredentials;
use Intervention\Httpauth\AbstractVault;

class Vault extends AbstractVault
{
    /**
     * Create new instance
     */
    public function __construct()
    {
        $this->credentials = new Credentials;
    }

    /**
     * Return auth value from environment information
     *
     * @return string
     */
    protected function getAuthValue(): ?string
    {
        switch ($this->getAuthType()) {
            case self::AUTH_TYPE_AUTH_USER:
                $username = $_SERVER['PHP_AUTH_USER'];
                $password = array_key_exists('PHP_AUTH_PW', $_SERVER) ? $_SERVER['PHP_AUTH_PW'] : null;
                return sprintf('basic_%s', base64_encode(implode(':', [
                    $username,
                    $password,
                ])));

            case self::AUTH_TYPE_AUTHENTICATION:
                return $_SERVER['HTTP_AUTHENTICATION'];

            case self::AUTH_TYPE_REDIRECT:
                return $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];

            default:
                return null;
        }
    }
    
    /**
     * Decode given auth value to Credentials object
     *
     * @param  string $value
     * @return AbstractCredentials
     */
    protected function decodeAuthValue($value): AbstractCredentials
    {
        $username = null;
        $password = null;

        if (strtolower(substr($value, 0, 5)) === 'basic') {
            list($username, $password) = explode(':', base64_decode(substr($value, 6)));
        }

        return new Credentials([
            'username' => $username,
            'password' => $password,
        ]);
    }

    /**
     * Build auth directive from current object
     *
     * @return string
     */
    public function getDirective(): string
    {
        return sprintf('Basic realm="%s", charset="UTF-8"', $this->getName());
    }
}
