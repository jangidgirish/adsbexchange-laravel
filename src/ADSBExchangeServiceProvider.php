<?php

namespace JangidGirish\ADSBExchange;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;

class ADSBExchangeServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Merge config
        $this->mergeConfigFrom(__DIR__ . '/../config/adsbexchange.php', 'adsbexchange');

        // HTTP client binding
        $this->app->singleton('adsbexchange.http', function () {
            return Http::withHeaders([
                'Accept' => 'application/json',
                'x-api-key' => config('adsbexchange.api_key'),
            ])->baseUrl(config('adsbexchange.base_url'));
        });

        // Client class binding
        $this->app->singleton('adsbexchange.client', function ($app) {
            return new ADSBExchangeClient($app->make('adsbexchange.http'));
        });
    }

    public function boot()
    {
        // Publish config
        $this->publishes([
            __DIR__ . '/../config/adsbexchange.php' => config_path('adsbexchange.php'),
        ], 'config');
    }
}
