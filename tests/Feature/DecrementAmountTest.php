<?php

use SertxuDeveloper\Counters\Counter;

test('can decrement amount', function () {
    $this->assertDatabaseCount('counters', 0);

    $counter = Counter::make('test');
    $counter->increment(10);

    expect($counter->decrement(3))->toBe(7);
    expect($counter->decrement(2))->toBe(5);
});

test('can decrement amount with year', function () {
    $this->assertDatabaseCount('counters', 0);

    $counter = Counter::make('test', 2021);
    $counter->increment(10);

    expect($counter->decrement(3))->toBe(7);
    expect($counter->decrement(2))->toBe(5);
});

test('can decrement amount with series', function () {
    $this->assertDatabaseCount('counters', 0);

    $counter = Counter::make('test', series: 'A');
    $counter->increment(10);

    expect($counter->decrement(3))->toBe(7);
    expect($counter->decrement(2))->toBe(5);
});

test('can decrement amount with year and series', function () {
    $this->assertDatabaseCount('counters', 0);

    $counter = Counter::make('test', 2021, 'A');
    $counter->increment(10);

    expect($counter->decrement(3))->toBe(7);
    expect($counter->decrement(2))->toBe(5);
});
