<?php

namespace Intervention\Httpauth\Token;

use Intervention\Httpauth\Key;

interface TokenInterface
{
    public function toKey(): Key;
}
