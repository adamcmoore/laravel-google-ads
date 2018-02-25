<?php

namespace LaravelGoogleAds;

use Illuminate\Support\ServiceProvider;

class LaravelGoogleAdsProvider extends ServiceProvider
{
    /**
     * Boot
     */
    public function boot()
    {
    }

    /**
     * Register package
     */
    public function register()
    {
        // Console commands
        $this->commands([
            Console\GenerateRefreshTokenCommand::class,
        ]);
    }
}