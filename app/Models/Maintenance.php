<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongTo;

class Maintenance extends Model
{
    public function locker(){
        return $this->belongTo(Locker::class);
    }
    public function user(){
        return $this->belongTo(User::class);
    }
    //
}
