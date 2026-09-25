<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloguent\Relations\BelongTo;


class LockerUsage extends Model
{

    public function User(){
        return $this->belongTo(User::class); 
    }
    //

    public function Locker(){
        return $this->belongTo(Locker::class);
    }
}
