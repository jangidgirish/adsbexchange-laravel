<?php

namespace JangidGirish\ADSBExchange\Facades;

use Illuminate\Support\Facades\Facade;

class ADSBExchange extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'adsbexchange';
    }
}

