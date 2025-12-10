<?php

namespace JangidGirish\ADSBExchange\Facades;

use Illuminate\Support\Facades\Facade;
/**
 * @method static \JangidGirish\ADSBExchange\ADSBExchange hax(string|array $hex)
 */
class ADSBExchange extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'adsbexchange.client';
    }
}
