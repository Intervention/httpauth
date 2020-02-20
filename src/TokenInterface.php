<?php

namespace Intervention\HttpAuth;

interface TokenInterface
{
    /**
     * Transform current instance to key object
     *
     * @return Key
     */
    public function toKey(): Key;
}
