<?php

namespace App\Http\Controllers;

use App\Models\LockerUsage;
use Illuminate\Support\Str;

class LockerUsageController extends Controller
{
    public function index()
    {
        $activeSessions = LockerUsage::with(['user', 'locker'])
            ->where('status', 'active')
            ->latest('started_at')
            ->get()
            ->map(fn ($usage) => $this->toRow($usage));

        $completedSessions = LockerUsage::with(['user', 'locker'])
            ->where('status', 'completed')
            ->latest('ended_at')
            ->take(50)
            ->get()
            ->map(fn ($usage) => $this->toRow($usage));

        return view('staff.locker-usage', [
            'activeSessions'    => $activeSessions,
            'completedSessions' => $completedSessions,
            'title'             => 'Locker Usage',
        ]);
    }

    // Turn one database row into the fields the table component expects
    private function toRow(LockerUsage $usage): object
    {
        $user = $usage->user;

        // active sessions are still running, so measure up to now
        $end     = $usage->ended_at ?? now();
        $minutes = $usage->started_at ? (int) abs($usage->started_at->diffInMinutes($end)) : 0;

        return (object) [
            'locker'     => $usage->locker?->name ?? ('#' . $usage->locker_id),
            'user'       => $user?->name ?: Str::before($user?->email ?? '-', '@'),
            'location'   => $usage->locker?->location?->name ?? '-',
            'start_time' => $usage->started_at?->format('h:i A') ?? '-',
            'duration'   => sprintf('%02d:%02d', intdiv($minutes, 60), $minutes % 60),
            'status'     => $usage->status,
        ];
    }
}