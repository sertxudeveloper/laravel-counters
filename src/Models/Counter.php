<?php

namespace SertxuDeveloper\Counters\Models;

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
     * Get the current connection name for the model.
     *
     * @return string
     */
    public function getConnectionName(): string
    {
        return config('counters.connection');
    }

    /**
     * Filter by key.
     */
    public function scopeKey($query, string $key): void
    {
        $query->where('key', $key);
    }

    /**
     * Filter by series.
     */
    public function scopeSeries($query, string $series): void
    {
        $query->where('series', $series);
    }

    /**
     * Filter by year.
     */
    public function scopeYear($query, string $year): void
    {
        $query->where('year', $year);
    }
}
