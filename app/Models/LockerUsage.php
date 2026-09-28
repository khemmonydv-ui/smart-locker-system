<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LockerUsage extends Model
{
    protected $fillable = ['user_id', 'locker_id', 'started_at', 'ended_at', 'status'];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at'   => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function locker(): BelongsTo
    {
        return $this->belongsTo(Locker::class);
    }
}