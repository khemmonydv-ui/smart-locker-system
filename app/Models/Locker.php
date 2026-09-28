<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Locker extends Model
{
    protected $table = 'lockers';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'location_id',
        'size',
        'status',
    ];

    // Relationship A locker belongs to one location
    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function lockerUsage(){
        return $this->hasMany(LockerUsage::class);
    }

    public function maintenance(){
        return $this->hasMany(Maintenance::class);
    }
}
