<?php

namespace Tests;

use SertxuDeveloper\Counters\Counter;

class NewYearTest extends TestCase
{
    public function test_counter_is_reset_when_year_changes(): void
    {
        $this->assertDatabaseCount('counters', 0);

        $counter = Counter::make('test', '2020');
        $counter->increment();
        $counter->increment();
        $counter->increment();

        $this->assertEquals(4, $counter->next());

        $counter = Counter::make('test', '2021');
        $counter->increment();

        $this->assertEquals(2, $counter->next());
    }
}
