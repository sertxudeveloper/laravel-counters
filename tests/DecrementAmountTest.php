<?php

namespace Tests;

use SertxuDeveloper\Counters\Counter;

class DecrementAmountTest extends TestCase
{
    public function test_can_decrement_amount(): void
    {
        $this->assertDatabaseCount('counters', 0);

        $counter = Counter::make('test');
        $counter->increment(10);

        $this->assertEquals(7, $counter->decrement(3));
        $this->assertEquals(5, $counter->decrement(2));
    }

    public function test_can_decrement_amount_with_year(): void
    {
        $this->assertDatabaseCount('counters', 0);

        $counter = Counter::make('test', '2021');
        $counter->increment(10);

        $this->assertEquals(7, $counter->decrement(3));
        $this->assertEquals(5, $counter->decrement(2));
    }

    public function test_can_decrement_amount_with_series(): void
    {
        $this->assertDatabaseCount('counters', 0);

        $counter = Counter::make('test', '', 'A');
        $counter->increment(10);

        $this->assertEquals(7, $counter->decrement(3));
        $this->assertEquals(5, $counter->decrement(2));
    }

    public function test_can_decrement_amount_with_year_and_series(): void
    {
        $this->assertDatabaseCount('counters', 0);

        $counter = Counter::make('test', '2021', 'A');
        $counter->increment(10);

        $this->assertEquals(7, $counter->decrement(3));
        $this->assertEquals(5, $counter->decrement(2));
    }
}
