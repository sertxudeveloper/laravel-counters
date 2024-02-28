<?php

namespace SertxuDeveloper\Counters;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class CounterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        if ($this->app->runningInConsole()) {
            /** Publish assets */
            // $this->publishes([
            //     dirname(__DIR__).'/resources/assets' => public_path('vendor/counters'),
            // ], 'counters-assets');

            /** Publish config */
            $this->publishes([
                dirname(__DIR__).'/config/counters.php' => $this->app->configPath('counters.php'),
            ], 'counters-config');
        }
    }

    /**
     * Register any application services.
     */
    public function register(): void {
        $this->registerConfig();

        $this->app->bind('counter', fn (Container $app) => new Counter());
    }

    /**
     * Register the package config.
     */
    protected function registerConfig(): void {
        $this->mergeConfigFrom(dirname(__DIR__).'/config/counters.php', 'counters');
    }
}
