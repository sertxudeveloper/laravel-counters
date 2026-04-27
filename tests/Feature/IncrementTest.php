<?php

use SertxuDeveloper\Counters\Counter;

test('can increment counter', function () {
    $this->assertDatabaseCount('counters', 0);

    Counter::make('test')->increment();

    $this->assertDatabaseHas('counters', [
        'key' => 'test',
        'year' => null,
        'series' => '',
        'value' => 1,
    ]);

    Counter::make('test')->increment();

    $this->assertDatabaseHas('counters', [
        'key' => 'test',
        'year' => null,
        'series' => '',
        'value' => 2,
    ]);
});

test('can increment counter with year', function () {
    $this->assertDatabaseCount('counters', 0);

    Counter::make('test', 2021)->increment();

    $this->assertDatabaseHas('counters', [
        'key' => 'test',
        'year' => 2021,
        'series' => '',
        'value' => 1,
    ]);

    Counter::make('test', 2021)->increment();

    $this->assertDatabaseHas('counters', [
        'key' => 'test',
        'year' => 2021,
        'series' => '',
        'value' => 2,
    ]);
});

test('can increment counter with series', function () {
    $this->assertDatabaseCount('counters', 0);

    Counter::make('test', series: 'A')->increment();

    $this->assertDatabaseHas('counters', [
        'key' => 'test',
        'year' => null,
        'series' => 'A',
        'value' => 1,
    ]);

    Counter::make('test', null, 'A')->increment();

    $this->assertDatabaseHas('counters', [
        'key' => 'test',
        'year' => null,
        'series' => 'A',
        'value' => 2,
    ]);
});

test('can increment counter with year and series', function () {
    $this->assertDatabaseCount('counters', 0);

    Counter::make('test', 2021, 'A')->increment();

    $this->assertDatabaseHas('counters', [
        'key' => 'test',
        'year' => 2021,
        'series' => 'A',
        'value' => 1,
    ]);

    Counter::make('test', 2021, 'A')->increment();

    $this->assertDatabaseHas('counters', [
        'key' => 'test',
        'year' => 2021,
        'series' => 'A',
        'value' => 2,
    ]);
});
