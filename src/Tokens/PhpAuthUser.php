<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Tokens;

use Intervention\HttpAuth\Exceptions\AuthentificationException;

class PhpAuthUser extends AbstractToken
{
    /**
     * Parse array of properties of current environment auth token
     *
     * @throws AuthentificationException
     * @return array{username: string, password: string}
     */
    public function parse(): array
    {
        $username = $this->getArrayValue($_SERVER, 'PHP_AUTH_USER');
        $password = $this->getArrayValue($_SERVER, 'PHP_AUTH_PW');

        if (empty($username) || empty($password)) {
            throw new AuthentificationException('Failed to parse token.');
        }

        return [
            'username' => $username,
            'password' => $password,
        ];
    }
}
