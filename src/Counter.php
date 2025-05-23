<?php

namespace SertxuDeveloper\Counters;

use Illuminate\Support\Facades\DB;
use SertxuDeveloper\Counters\Exceptions\MinimumValueException;
use SertxuDeveloper\Counters\Models\Counter as CounterModel;

class Counter
{
    /**
     * The number of milliseconds to wait before re-attempting to acquire a lock while blocking.
     */
    protected int $sleepMilliseconds = 250;

    /**
     * The number of tries to acquire a lock while blocking.
     */
    protected int $tries = 10;

    /**
     * The key of the counter.
     */
    protected string $key;

    /**
     * The year of the counter.
     */
    protected string $year = '';

    /**
     * The series of the counter.
     */
    protected string $series = '';

    /**
     * Create a new counter instance.
     */
    public static function make(string $key, string $year = '', string $series = ''): static
    {
        $counter = new static;

        $counter->key = $key;
        $counter->year = $year;
        $counter->series = $series;

        return $counter;
    }

    /**
     * Increment the counter by the given amount.
     */
    public function increment(int $amount = 1): int
    {
        return $this->incrementOrDecrement(method: 'increment', amount: $amount);
    }

    /**
     * Decrement the counter by the given amount.
     */
    public function decrement(int $amount = 1): int
    {
        return $this->incrementOrDecrement(method: 'decrement', amount: $amount);
    }

    /**
     * Decrement the counter by the given amount using atomic operations and return the new value.
     *
     * @param  string  $method  The method to use, either 'increment' or 'decrement'.
     * @param  int  $amount  The amount to increment or decrement.
     */
    protected function incrementOrDecrement(string $method, int $amount): int
    {
        $amount = ($method === 'increment' ? $amount : $amount * -1);

        return DB::transaction(function () use ($amount) {
            $counter = CounterModel::query()
                ->lockForUpdate()
                ->firstOrCreate([
                    'key' => $this->key,
                    'year' => $this->year,
                    'series' => $this->series,
                ]);

            $value = $counter->value + $amount;
            throw_if($value <= 0, MinimumValueException::class);

            CounterModel::query()
                ->key($this->key)
                ->year($this->year)
                ->series($this->series)
                ->update(['value' => $value]);

            return $value;
        });
    }

    /**
     * Get the next value of the counter.
     */
    public function next(): int
    {
        return $this->increment();
    }
}
