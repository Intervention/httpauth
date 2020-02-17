<?php

namespace Intervention\Httpauth\Facades;

use Illuminate\Support\Facades\Facade;

class Httpauth extends Facade
{
    /**
     * Return facade accessor
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'httpauth';
    }
}
