<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as Orchestra;
use SertxuDeveloper\Counters\CounterServiceProvider;

class TestCase extends Orchestra
{
    use RefreshDatabase;

    /**
     * Define database migrations.
     */
    protected function defineDatabaseMigrations(): void {
        $this->loadLaravelMigrations();
        $this->loadMigrationsFrom(dirname(__DIR__).'/database/migrations');
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array<int, class-string>
     */
    protected function getPackageProviders($app): array
    {
        return [
            CounterServiceProvider::class,
        ];
    }
}
