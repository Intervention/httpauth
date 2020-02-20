<?php

namespace Intervention\HttpAuth\Token;

class HttpAuthorization extends PhpAuthDigest
{
    /**
     * Parse environment variables and store value in object
     *
     * @return bool "true" if value was found or "false"
     */
    protected function parse(): bool
    {
        $value = $this->getArrayValue($_SERVER, 'HTTP_AUTHORIZATION');
        if (strtolower(substr($value, 0, 6)) === 'digest') {
            $this->value = $value;

            return true;
        }

        return false;
    }
}
