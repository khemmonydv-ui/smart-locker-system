<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // FIXED: was "BelongTo"

class Maintenance extends Model
{
    // Status values in ONE place, so you never mistype a string like 'resolvd'.
    public const STATUS_PENDING     = 'pending';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_RESOLVED    = 'resolved';

    // IMPORTANT: without $fillable, Maintenance::create([...]) throws
    // a MassAssignmentException.
    protected $fillable = [
        'locker_id', 'user_id', 'assigned_to',
        'problem', 'status', 'is_urgent',
        'reported_at', 'resolved_at',
    ];

    // Convert columns to real types so ->format() and boolean checks work.
    protected $casts = [
        'is_urgent'   => 'boolean',
        'reported_at' => 'datetime',
        'resolved_at' => 'datetime',
    ];

    // The locker that has the problem.
    public function locker(): BelongsTo
    {
        return $this->belongsTo(Locker::class); // FIXED: was "belongTo"
    }

    // The user who reported the problem (maintenances.user_id).
    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // The staff member assigned to fix it (maintenances.assigned_to).
    // IMPORTANT: the column name is passed explicitly because two relations
    // point to the users table and Laravel cannot guess which is which.
    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}