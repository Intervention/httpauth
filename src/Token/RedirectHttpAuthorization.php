<?php

namespace Intervention\HttpAuth\Token;

class RedirectHttpAuthorization extends HttpAuthentification
{
    /**
     * Parse environment variables and store value in object
     *
     * @return bool "true" if value was found or "false"
     */
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
