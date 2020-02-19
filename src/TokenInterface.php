<?php

namespace Intervention\HttpAuth;

interface TokenInterface
{
    public function toKey(): Key;
}
