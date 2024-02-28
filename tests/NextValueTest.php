<?php

namespace Tests;

use SertxuDeveloper\Counters\Counter;

class NextValueTest extends TestCase
{
    public function test_can_get_next_value(): void
    {
        $this->assertDatabaseCount('counters', 0);

        $this->assertEquals(1, Counter::make('test')->next());
        $this->assertEquals(2, Counter::make('test')->next());
        $this->assertEquals(3, Counter::make('test')->next());
    }

    public function test_can_get_next_value_with_year(): void
    {
        $this->assertDatabaseCount('counters', 0);

        $this->assertEquals(1, Counter::make('test', '2021')->next());
        $this->assertEquals(2, Counter::make('test', '2021')->next());
        $this->assertEquals(3, Counter::make('test', '2021')->next());
    }

    public function test_can_get_next_value_with_series(): void
    {
        $this->assertDatabaseCount('counters', 0);

        $this->assertEquals(1, Counter::make('test', '', 'A')->next());
        $this->assertEquals(2, Counter::make('test', '', 'A')->next());
        $this->assertEquals(3, Counter::make('test', '', 'A')->next());
    }

    public function test_can_get_next_value_with_year_and_series(): void
    {
        $this->assertDatabaseCount('counters', 0);

        $this->assertEquals(1, Counter::make('test', '2021', 'A')->next());
        $this->assertEquals(2, Counter::make('test', '2021', 'A')->next());
        $this->assertEquals(3, Counter::make('test', '2021', 'A')->next());
    }
}
