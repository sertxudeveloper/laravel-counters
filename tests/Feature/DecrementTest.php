<?php

use SertxuDeveloper\Counters\Counter;

test('can decrement value', function () {
    $this->assertDatabaseCount('counters', 0);

    $counter = Counter::make('test');
    $counter->increment();
    $counter->increment();
    $counter->increment();

    expect($counter->decrement())->toBe(2);
    expect($counter->decrement())->toBe(1);
});

test('can decrement value with year', function () {
    $this->assertDatabaseCount('counters', 0);

    $counter = Counter::make('test', '2021');
    $counter->increment();
    $counter->increment();
    $counter->increment();

    expect($counter->decrement())->toBe(2);
    expect($counter->decrement())->toBe(1);
});

test('can decrement value with series', function () {
    $this->assertDatabaseCount('counters', 0);

    $counter = Counter::make('test', series: 'A');
    $counter->increment();
    $counter->increment();
    $counter->increment();

    expect($counter->decrement())->toBe(2);
    expect($counter->decrement())->toBe(1);
});

test('can decrement value with year and series', function () {
    $this->assertDatabaseCount('counters', 0);

    $counter = Counter::make('test', 2021, 'A');
    $counter->increment();
    $counter->increment();
    $counter->increment();

    expect($counter->decrement())->toBe(2);
    expect($counter->decrement())->toBe(1);
});
