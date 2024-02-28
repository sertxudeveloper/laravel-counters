<?php

namespace Tests;

use SertxuDeveloper\Counters\Counter;

class CreateCounterTest extends TestCase
{
    public function test_creates_counter_if_not_exists(): void
    {
        $this->assertDatabaseCount('counters', 0);

        Counter::make('test')->increment();

        $this->assertDatabaseCount('counters', 1);

        $this->assertDatabaseHas('counters', [
            'key' => 'test',
            'year' => '',
            'series' => '',
        ]);
    }

    public function test_creates_counter_if_not_exists_with_year(): void
    {
        $this->assertDatabaseCount('counters', 0);

        Counter::make('test', '2021')->increment();

        $this->assertDatabaseCount('counters', 1);

        $this->assertDatabaseHas('counters', [
            'key' => 'test',
            'year' => '2021',
            'series' => '',
        ]);
    }

    public function test_creates_counter_if_not_exists_with_series(): void
    {
        $this->assertDatabaseCount('counters', 0);

        Counter::make('test', '', 'A')->increment();

        $this->assertDatabaseCount('counters', 1);

        $this->assertDatabaseHas('counters', [
            'key' => 'test',
            'year' => '',
            'series' => 'A',
        ]);
    }

    public function test_creates_counter_if_not_exists_with_year_and_series(): void
    {
        $this->assertDatabaseCount('counters', 0);

        Counter::make('test', '2021', 'A')->increment();

        $this->assertDatabaseCount('counters', 1);

        $this->assertDatabaseHas('counters', [
            'key' => 'test',
            'year' => '2021',
            'series' => 'A',
        ]);
    }
}
