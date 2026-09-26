<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
        'address',
        'distance_km',
        'available_slots',
        'is_open',
    ];

    protected $casts = [
        'is_open' => 'boolean',
        'distance_km' => 'float',
        'available_slots' => 'integer',
    ];
}
