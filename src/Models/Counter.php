<?php

declare(strict_types=1);

namespace SertxuDeveloper\Counters\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key', 'year', 'series', 'value',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'value' => 'integer',
    ];

    /**
     * Filter by key.
     */
    public function scopeKey(Builder $query, string $key): void
    {
        $query->where('key', $key);
    }

    /**
     * Filter by series.
     */
    public function scopeSeries(Builder $query, string $series = ''): void
    {
        $query->where('series', $series);
    }

    /**
     * Filter by year.
     */
    public function scopeYear(Builder $query, ?int $year = null): void
    {
        $query->when(fn (Builder $query) => $query->where('year', $year));
    }
}
