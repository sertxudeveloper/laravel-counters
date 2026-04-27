<?php

use SertxuDeveloper\Counters\Counter;

test('creates counter if not exists', function () {
    $this->assertDatabaseCount('counters', 0);

    Counter::make('test')->increment();

    $this->assertDatabaseCount('counters', 1);
    $this->assertDatabaseHas('counters', [
        'key' => 'test',
        'year' => null,
        'series' => '',
    ]);
});

test('creates counter if not exists with year', function () {
    $this->assertDatabaseCount('counters', 0);

    Counter::make('test', 2021)->increment();

    $this->assertDatabaseCount('counters', 1);
    $this->assertDatabaseHas('counters', [
        'key' => 'test',
        'year' => 2021,
        'series' => '',
    ]);
});

test('creates counter if not exists with series', function () {
    $this->assertDatabaseCount('counters', 0);

    Counter::make('test', series: 'A')->increment();

    $this->assertDatabaseCount('counters', 1);
    $this->assertDatabaseHas('counters', [
        'key' => 'test',
        'year' => null,
        'series' => 'A',
    ]);
});

test('creates counter if not exists with year and series', function () {
    $this->assertDatabaseCount('counters', 0);

    Counter::make('test', 2021, 'A')->increment();

    $this->assertDatabaseCount('counters', 1);
    $this->assertDatabaseHas('counters', [
        'key' => 'test',
        'year' => 2021,
        'series' => 'A',
    ]);
});
