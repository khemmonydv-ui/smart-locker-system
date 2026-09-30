<?php

namespace App\Http\Controllers;

use App\Models\LockerUsage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
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
}
