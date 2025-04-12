<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Связь один ко многим между таблицами 'car' и 'configuration'
     *
     * @return HasMany
     */
    public function configurations(): HasMany
    {
        return $this->hasMany(Configuration::class);
    }
}
