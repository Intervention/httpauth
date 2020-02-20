<?php

namespace Intervention\HttpAuth\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class HttpAuth extends Facade
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
