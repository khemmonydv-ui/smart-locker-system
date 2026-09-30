<?php

namespace App\Http\Controllers;

use App\Models\LockerUsage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class LockerUsageController extends Controller
{
    public function show(): View|RedirectResponse
    {
        $usage = LockerUsage::with(['locker.location'])
            ->where('user_id', Auth::id())
            ->whereNull('ended_at')
            ->latest('started_at')
            ->first();

        if (! $usage) {
            return redirect()->route('locations.index')
                ->with('status', 'You have no active locker right now.');
        }

        return view('lockers.show', ['usage' => $usage]);
    }

    public function unlock(LockerUsage $usage): RedirectResponse
    {
        return back()->with('status', 'Locker unlocked.');
    }

    public function release(LockerUsage $usage): RedirectResponse
    {
        $usage->update(['ended_at' => now()]);

        return redirect()->route('locations.index')->with('status', 'Locker released.');
    }

    // Staff-facing table of locker sessions.
    // NOTE: this queries a "status" column on locker_usages that doesn't
    // exist in the current migration (which only has started_at/ended_at).
    // Not wired to a route yet — add a migration for `status`, or rewrite
    // the two queries below to use whereNull('ended_at') / whereNotNull('ended_at')
    // instead, before enabling this.
    public function index(): View
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
