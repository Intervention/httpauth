<?php

declare(strict_types=1);

namespace Intervention\HttpAuth;

enum Type: string
{
    case BASIC = 'basic';
    case DIGEST = 'digest';
}
