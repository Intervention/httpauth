<?php

namespace Intervention\HttpAuth\Token;

class HttpAuthorization extends PhpAuthDigest
{
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
