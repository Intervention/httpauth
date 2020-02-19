<?php

namespace Intervention\HttpAuth\Token;

class RedirectHttpAuthorization extends HttpAuthentification
{
    protected function parse(): bool
    {
        $value = $this->getArrayValue($_SERVER, 'REDIRECT_HTTP_AUTHORIZATION');
        if (strtolower(substr($value, 0, 5)) === 'basic') {
            $this->value = $value;

            return true;
        }

        return false;
    }
}
