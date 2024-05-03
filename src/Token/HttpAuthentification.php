<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Token;

use Intervention\HttpAuth\Exception\AuthentificationException;

class HttpAuthentification extends AbstractToken
{
    /**
     * Parse array of properties of current environment auth token
     *
     * @throws AuthentificationException
     * @return array{username: string, password: string}
     */
    public function parse(): array
    {
        $value = $this->getArrayValue($_SERVER, 'HTTP_AUTHENTICATION');

        if (is_null($value)) {
            throw new AuthentificationException('Failed to parse token.');
        }

        if (strtolower(substr($value, 0, 5)) !== 'basic') {
            throw new AuthentificationException('Failed to parse token.');
        }

        $data = explode(':', base64_decode(substr($value, 6)));

        return [
            'username' => $this->getArrayValue($data, 0),
            'password' => $this->getArrayValue($data, 1),
        ];
    }
}
