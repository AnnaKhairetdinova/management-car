<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Price extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'configuration_id',
        'price',
        'start_date',
        'end_date',
    ];

    /**
     * Связь один к одному между таблицами 'price' и 'configurations'
     *
     * @return HasOne
     */
    public function configuration(): HasOne
    {
        return $this->hasOne(Configuration::class);
    }
}
