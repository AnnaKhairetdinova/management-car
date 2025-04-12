<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Свяязь многие ко многим между таблицами 'configuration' и 'options'
     *
     * @return BelongsToMany
     */
    public function configurations(): BelongsToMany
    {
        return $this->belongsToMany(Configuration::class, 'configuration_option', 'option_id', 'configuration_id');
    }
}
