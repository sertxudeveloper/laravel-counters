<?php

namespace SertxuDeveloper\Counters;

use SertxuDeveloper\Counters\Models\Counter as CounterModel;
use Throwable;

class Counter
{
    /**
     * The number of milliseconds to wait before re-attempting to acquire a lock while blocking.
     *
     * @var int
     */
    protected int $sleepMilliseconds = 250;

    /**
     * The number of tries to acquire a lock while blocking.
     *
     * @var int
     */
    protected int $tries = 10;

    /**
     * The key of the counter.
     *
     * @var string
     */
    protected string $key;

    /**
     * The year of the counter.
     *
     * @var string
     */
    protected string $year = '';

    /**
     * The series of the counter.
     *
     * @var string
     */
    protected string $series = '';

    /**
     * Create a new counter instance.
     *
     * @param string $key
     * @param string $year
     * @param string $series
     * @return static
     */
    static public function make(string $key, string $year = '', string $series = ''): static
    {
        $counter = new static();

        $counter->key = $key;
        $counter->year = $year;
        $counter->series = $series;

        return $counter;
    }

    /**
     * Increment the counter by the given amount.
     *
     * @param int $amount
     * @return int
     */
    public function increment(int $amount = 1): int
    {
        return $this->incrementOrDecrement(method: 'increment', amount: $amount);
    }

    /**
     * Decrement the counter by the given amount.
     *
     * @param int $amount
     * @return int
     */
    public function decrement(int $amount = 1): int
    {
        return $this->incrementOrDecrement(method: 'decrement', amount: $amount);
    }

    /**
     * Decrement the counter by the given amount using atomic operations and return the new value.
     *
     * @param string $method The method to use, either 'increment' or 'decrement'.
     * @param int $amount The amount to increment or decrement.
     *
     * @return int
     */
    protected function incrementOrDecrement(string $method, int $amount): int
    {
        $amount = ($method === 'increment' ? $amount : $amount * -1);

        return retry(
            times: $this->tries,
            callback: function () use ($amount): int {
                $counter = CounterModel::query()
                    ->firstOrCreate([
                        'key' => $this->key,
                        'year' => $this->year,
                        'series' => $this->series,
                    ]);

                $value = $counter->value + $amount;
                throw_if($value <= 0, MinimumValueException::class);

                $updated = CounterModel::query()
                    ->key($this->key)
                    ->year($this->year)
                    ->series($this->series)
                    ->where('value', $counter->value)
                    ->update(['value' => $value]);

                throw_if($updated === 0, RaceConditionException::class);

                return $value;
            },
            sleepMilliseconds: $this->sleepMilliseconds,
            when: function (Throwable $e) {
                return !($e instanceof MinimumValueException);
            }
        );
    }

    /**
     * Get the next value of the counter.
     *
     * @return int
     */
    public function next(): int
    {
        return $this->increment();
    }
}
