<?php

namespace Intervention\HttpAuth\Token;

use Intervention\HttpAuth\Exception\AuthentificationException;

class PhpAuthUser extends AbstractToken
{
    protected function parseProperties(): array
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
