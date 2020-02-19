<?php

namespace Intervention\Httpauth\Token;

use Intervention\Httpauth\Key;

class NullToken extends AbstractToken
{
    public function toKey(): Key
    {
        return new Key;
    }

    protected function parse(): bool
    {
        return true;
    }
}
