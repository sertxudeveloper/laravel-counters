<?php

use SertxuDeveloper\Counters\Counter;

test('can get next value', function () {
    $this->assertDatabaseCount('counters', 0);

    expect(Counter::make('test')->next())->toBe(1);
    expect(Counter::make('test')->next())->toBe(2);
    expect(Counter::make('test')->next())->toBe(3);
});

test('can get next value with year', function () {
    $this->assertDatabaseCount('counters', 0);

    expect(Counter::make('test', '2021')->next())->toBe(1);
    expect(Counter::make('test', '2021')->next())->toBe(2);
    expect(Counter::make('test', '2021')->next())->toBe(3);
});

test('can get next value with series', function () {
    $this->assertDatabaseCount('counters', 0);

    expect(Counter::make('test', series: 'A')->next())->toBe(1);
    expect(Counter::make('test', series: 'A')->next())->toBe(2);
    expect(Counter::make('test', series: 'A')->next())->toBe(3);
});

test('can get next value with year and series', function () {
    $this->assertDatabaseCount('counters', 0);

    expect(Counter::make('test', 2021, 'A')->next())->toBe(1);
    expect(Counter::make('test', 2021, 'A')->next())->toBe(2);
    expect(Counter::make('test', 2021, 'A')->next())->toBe(3);
});
