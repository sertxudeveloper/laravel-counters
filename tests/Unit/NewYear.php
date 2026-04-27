<?php

use SertxuDeveloper\Counters\Counter;

test('counter is reset when year changes', function () {
    $this->assertDatabaseCount('counters', 0);

    $counter = Counter::make('test', '2020');
    $counter->increment();
    $counter->increment();
    $counter->increment();

    expect($counter->next())->toBe(4);

    $counter = Counter::make('test', '2021');
    $counter->increment();

    expect($counter->next())->toBe(2);
});
