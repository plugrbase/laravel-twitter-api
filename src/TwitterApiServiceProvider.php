<?php

namespace Plugrbase\TwitterApi;

use Illuminate\Support\ServiceProvider;

class TwitterApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('twitter-api.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'twitter-api');

        // Register the main class to use with the facade
        $this->app->singleton('twitter-api', function () {
            return new TwitterApi();
        });
    }
}
