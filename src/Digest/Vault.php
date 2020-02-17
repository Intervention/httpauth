<?php

namespace Intervention\Httpauth\Digest;

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
            case self::AUTH_TYPE_AUTH_DIGEST:
                return $_SERVER['PHP_AUTH_DIGEST'];

            case self::AUTH_TYPE_AUTHORIZATION:
                return $_SERVER['HTTP_AUTHORIZATION'];

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
        $credentials = new Credentials;
        if (strtolower(substr($value, 0, 6)) === 'digest') {
            preg_match_all('@(\w+)=(?:(?:")([^"]+)"|([^\s,$]+))@', $value, $matches, PREG_SET_ORDER);
            foreach ($matches as $m) {
                $key = $m[1];
                $value = $m[2] ? $m[2] : $m[3];
                $credentials->set($key, $value);
            }
        }

        return $credentials;
    }

    /**
     * Build auth directive from current object
     *
     * @return string
     */
    public function getDirective(): string
    {
        $parameters = [
            'realm' => $this->getName(),
            'qop' => 'auth',
            'nonce' => uniqid(),
            'opaque' => md5($this->getName()),
        ];

        $result = [];
        foreach ($parameters as $key => $value) {
            $result[] = $key.'="'.$value.'"';
        }

        return sprintf('Digest %s', implode(',', $result));
    }
}
