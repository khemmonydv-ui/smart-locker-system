<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['location_id', 'name', 'status', 'size'])]
class Locker extends Model
{
    use HasFactory;

    // One locker belongs to one location
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

<<<<<<< HEAD
    // One locker has many usage records
    public function lockerUsages(): HasMany
    {
        return $this->hasMany(LockerUsage::class);
=======
    public function lockerUsage(){
        return $this->hasMany(LockerUage::class);
>>>>>>> e97a97b (just only static)
    }

    // One locker has many maintenance records
    public function maintenances(): HasMany
    {
        return $this->hasMany(Maintenance::class);
    }
}
