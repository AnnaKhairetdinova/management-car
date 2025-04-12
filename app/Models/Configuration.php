<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Configuration extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'name',
    ];

    /**
     * Связь один ко многим между таблицами 'cars' и 'configurations'
     *
     * @return BelongsTo
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'car_id');
    }

    /**
     * Связь один к одному между таблицами 'price' и 'configurations'
     *
     * @return HasMany
     */
    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }

    /**
     * Свяязь многие ко многим между таблицами 'configurations' и 'options'
     *
     * @return BelongsToMany
     */
    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class, 'configuration_options', 'configuration_id', 'option_id');
    }
}
