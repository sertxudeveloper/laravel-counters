<?php

declare(strict_types=1);

namespace SertxuDeveloper\Counters\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as BaseTestCase;
use SertxuDeveloper\Counters\CounterServiceProvider;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    protected function getPackageProviders($app): array
    {
        return [
            CounterServiceProvider::class,
        ];
    }
}
