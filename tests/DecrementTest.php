<?php

namespace Tests;

use SertxuDeveloper\Counters\Counter;

class DecrementTest extends TestCase
{
    public function test_can_decrement_value(): void
    {
        $this->assertDatabaseCount('counters', 0);

        $counter = Counter::make('test');
        $counter->increment();
        $counter->increment();
        $counter->increment();

        $this->assertEquals(2, $counter->decrement());
        $this->assertEquals(1, $counter->decrement());
    }

    public function test_can_decrement_value_with_year(): void
    {
        $this->assertDatabaseCount('counters', 0);

        $counter = Counter::make('test', '2021');
        $counter->increment();
        $counter->increment();
        $counter->increment();

        $this->assertEquals(2, $counter->decrement());
        $this->assertEquals(1, $counter->decrement());
    }

    public function test_can_decrement_value_with_series(): void
    {
        $this->assertDatabaseCount('counters', 0);

        $counter = Counter::make('test', series: 'A');
        $counter->increment();
        $counter->increment();
        $counter->increment();

        $this->assertEquals(2, $counter->decrement());
        $this->assertEquals(1, $counter->decrement());
    }

    public function test_can_decrement_value_with_year_and_series(): void
    {
        $this->assertDatabaseCount('counters', 0);

        $counter = Counter::make('test', 2021, 'A');
        $counter->increment();
        $counter->increment();
        $counter->increment();

        $this->assertEquals(2, $counter->decrement());
        $this->assertEquals(1, $counter->decrement());
    }
}
