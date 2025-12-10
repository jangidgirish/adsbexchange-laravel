<?php

namespace JangidGirish\ADSBExchange;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;

class ADSBExchangeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/adsbexchange.php', 'adsbexchange'
        );

        $this->app->singleton('adsbexchange', function () {
            return Http::withHeaders([
                'Accept' => 'application/json',
                'Accept-Encoding' => 'gzip',
                'x-api-key' => config('adsbexchange.api_key'),
            ])->baseUrl(config('adsbexchange.base_url'));
        });

        $this->app->singleton(ADSBExchangeClient::class, function () {
            return new ADSBExchangeClient(app('adsbexchange'));
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/adsbexchange.php' => config_path('adsbexchange.php'),
        ], 'config');
    }
}

