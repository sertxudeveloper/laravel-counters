<?php

namespace Tests;

use SertxuDeveloper\Counters\Counter;

class IncrementTest extends TestCase
{
    public function test_can_increment_counter(): void
    {
        $this->assertDatabaseCount('counters', 0);

        Counter::make('test')->increment();

        $this->assertDatabaseHas('counters', [
            'key' => 'test',
            'year' => '',
            'series' => '',
            'value' => 1,
        ]);

        Counter::make('test')->increment();

        $this->assertDatabaseHas('counters', [
            'key' => 'test',
            'year' => '',
            'series' => '',
            'value' => 2,
        ]);
    }

    public function test_can_increment_counter_with_year(): void
    {
        $this->assertDatabaseCount('counters', 0);

        Counter::make('test', '2021')->increment();

        $this->assertDatabaseHas('counters', [
            'key' => 'test',
            'year' => '2021',
            'series' => '',
            'value' => 1,
        ]);

        Counter::make('test', '2021')->increment();

        $this->assertDatabaseHas('counters', [
            'key' => 'test',
            'year' => '2021',
            'series' => '',
            'value' => 2,
        ]);
    }

    public function test_can_increment_counter_with_series(): void
    {
        $this->assertDatabaseCount('counters', 0);

        Counter::make('test', '', 'A')->increment();

        $this->assertDatabaseHas('counters', [
            'key' => 'test',
            'year' => '',
            'series' => 'A',
            'value' => 1,
        ]);

        Counter::make('test', '', 'A')->increment();

        $this->assertDatabaseHas('counters', [
            'key' => 'test',
            'year' => '',
            'series' => 'A',
            'value' => 2,
        ]);
    }

    public function test_can_increment_counter_with_year_and_series(): void
    {
        $this->assertDatabaseCount('counters', 0);

        Counter::make('test', '2021', 'A')->increment();

        $this->assertDatabaseHas('counters', [
            'key' => 'test',
            'year' => '2021',
            'series' => 'A',
            'value' => 1,
        ]);

        Counter::make('test', '2021', 'A')->increment();

        $this->assertDatabaseHas('counters', [
            'key' => 'test',
            'year' => '2021',
            'series' => 'A',
            'value' => 2,
        ]);
    }

}
