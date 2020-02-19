<?php

namespace Intervention\Httpauth;

interface TokenInterface
{
    public function toKey(): Key;
}
