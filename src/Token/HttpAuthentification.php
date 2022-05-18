<?php

namespace Intervention\HttpAuth\Token;

use Intervention\HttpAuth\Exception\AuthentificationException;

class HttpAuthentification extends AbstractToken
{
    /**
     * Parse array of properties of current environment auth token
     *
     * @return array
     * @throws AuthentificationException
     */
    protected function parseProperties(): array
    {
        $value = $this->getArrayValue($_SERVER, 'HTTP_AUTHENTICATION');

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
