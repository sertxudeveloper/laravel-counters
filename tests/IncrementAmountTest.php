<?php

namespace Tests;

use SertxuDeveloper\Counters\Counter;

class IncrementAmountTest extends TestCase
{
    public function test_can_increment_counter_by_amount(): void
    {
        $this->assertDatabaseCount('counters', 0);

        Counter::make('test')->increment(5);

        $this->assertDatabaseHas('counters', [
            'key' => 'test',
            'year' => null,
            'series' => '',
            'value' => 5,
        ]);

        Counter::make('test')->increment(3);

        $this->assertDatabaseHas('counters', [
            'key' => 'test',
            'year' => null,
            'series' => '',
            'value' => 8,
        ]);
    }

    public function test_can_increment_counter_by_amount_with_year(): void
    {
        $this->assertDatabaseCount('counters', 0);

        Counter::make('test', 2021)->increment(5);

        $this->assertDatabaseHas('counters', [
            'key' => 'test',
            'year' => '2021',
            'series' => '',
            'value' => 5,
        ]);

        Counter::make('test', 2021)->increment(3);

        $this->assertDatabaseHas('counters', [
            'key' => 'test',
            'year' => 2021,
            'series' => '',
            'value' => 8,
        ]);
    }

    public function test_can_increment_counter_by_amount_with_series(): void
    {
        $this->assertDatabaseCount('counters', 0);

        Counter::make('test', series: 'A')->increment(5);

        $this->assertDatabaseHas('counters', [
            'key' => 'test',
            'year' => null,
            'series' => 'A',
            'value' => 5,
        ]);

        Counter::make('test', series: 'A')->increment(3);

        $this->assertDatabaseHas('counters', [
            'key' => 'test',
            'year' => null,
            'series' => 'A',
            'value' => 8,
        ]);
    }

    public function test_can_increment_counter_by_amount_with_year_and_series(): void
    {
        $this->assertDatabaseCount('counters', 0);

        Counter::make('test', 2021, 'A')->increment(5);

        $this->assertDatabaseHas('counters', [
            'key' => 'test',
            'year' => 2021,
            'series' => 'A',
            'value' => 5,
        ]);

        Counter::make('test', 2021, 'A')->increment(3);

        $this->assertDatabaseHas('counters', [
            'key' => 'test',
            'year' => 2021,
            'series' => 'A',
            'value' => 8,
        ]);
    }
}
