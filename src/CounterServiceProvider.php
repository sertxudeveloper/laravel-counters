<?php

declare(strict_types=1);

namespace SertxuDeveloper\Counters;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class CounterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            /** Load migrations */
            $this->loadMigrationsFrom(dirname(__DIR__).'/database/migrations');
        }
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('counter', fn (Container $app) => new Counter);
    }
}
