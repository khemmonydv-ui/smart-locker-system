<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Locker extends Model
{

    public function location(){
        return $this->BelongTo(Location::class);
    }

    public function lockerUsage(){
        return $this->hasMany(LockerUage::class);
    }

    public function maintenance(){
        return $this->hasMany(Maintenance::class);
    }
    //
}
