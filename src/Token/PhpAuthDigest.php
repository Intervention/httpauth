<?php

namespace Intervention\HttpAuth\Token;

use Intervention\HttpAuth\Key;

class PhpAuthDigest extends NullToken
{
    /**
     * Parsed authentification value
     *
     * @var string
     */
    protected $value;

    /**
     * Transform current instance to key object
     *
     * @return Key
     */
    public function toKey(): Key
    {
        $authKey = new Key;
        preg_match_all('@(\w+)=(?:(?:")([^"]+)"|([^\s,$]+))@', $this->value, $matches, PREG_SET_ORDER);
        foreach ($matches as $m) {
            $key = $m[1];
            $value = $m[2] ? $m[2] : $m[3];
            $authKey->setProperty($key, $value);
        }

        return $authKey;
    }

    /**
     * Parse environment variables and store value in object
     *
     * @return bool "true" if value was found or "false"
     */
    protected function parse(): bool
    {
        if ($value = $this->getArrayValue($_SERVER, 'PHP_AUTH_DIGEST')) {
            $this->value = $value;

            return true;
        }

        return false;
    }
}
