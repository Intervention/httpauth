<?php

declare(strict_types=1);

namespace Intervention\HttpAuth\Interfaces;

interface DirectiveInterface
{
    /**
     * Cast directive to string
     */
    public function __toString(): string;
}
