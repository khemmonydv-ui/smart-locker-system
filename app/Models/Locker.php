<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locker extends Model
{
    protected $fillable = [
        'name',
        'status',
        'size',
        'user_id',
        'location_id',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function usages()
    {
        return $this->hasMany(LockerUsage::class);
    }
}
