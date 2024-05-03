<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Token;

use Intervention\HttpAuth\Exception\AuthentificationException;

class RedirectHttpAuthorization extends AbstractToken
{
    /**
     * Parse array of properties of current environment auth token
     *
     * @throws AuthentificationException
     * @return array{username: string, password: string}
     */
    public function parse(): array
    {
        $value = $this->getArrayValue($_SERVER, 'REDIRECT_HTTP_AUTHORIZATION');

        if (is_null($value)) {
            throw new AuthentificationException('Failed to parse token.');
        }

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
