<?php

namespace Intervention\HttpAuth\Token;

use Intervention\HttpAuth\Exception\AuthentificationException;

class RedirectHttpAuthorization extends AbstractToken
{
    /**
     * Parse array of properties of current environment auth token
     *
     * @return array
     * @throws AuthentificationException
     */
    protected function parseProperties(): array
    {
        $value = $this->getArrayValue($_SERVER, 'REDIRECT_HTTP_AUTHORIZATION');

        if (strtolower(substr($value, 0, 5)) !== 'basic') {
            throw new AuthentificationException('Failed to parse token.');
        }

        list($username, $password) = explode(':', base64_decode(substr($value, 6)));

        return [
            'username' => $username,
            'password' => $password,
        ];
    }
}
