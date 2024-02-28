<?php

namespace {PackageVendor}\{PackageName};

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class {PackageName}ServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        if ($this->app->runningInConsole()) {
            /** Publish assets */
            // $this->publishes([
            //     dirname(__DIR__).'/resources/assets' => public_path('vendor/{package_name}'),
            // ], '{package_name}-assets');

            /** Publish config */
            $this->publishes([
                dirname(__DIR__).'/config/{package_name}.php' => $this->app->configPath('{package_name}.php'),
            ], '{package_name}-config');
        }
    }

    /**
     * Register any application services.
     */
    public function register(): void {
        $this->registerConfig();

        $this->app->singleton('{package_name}', function (Container $app) {
            return new {PackageName};
        });
    }

    /**
     * Register the package config.
     */
    protected function registerConfig(): void {
        $this->mergeConfigFrom(dirname(__DIR__).'/config/{package_name}.php', '{package_name}');
    }
}