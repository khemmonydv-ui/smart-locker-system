<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{   
    protected $table = 'locations';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'address',
    ];

    // Relationship One locations has many lockers
    public function lockers(){
        return $this->hasMany(Locker::class);
    }
    //
}
