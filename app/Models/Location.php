<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{   
    public function locker(){
        return $this->hasMany(Locker::class);
    }
    //
}
