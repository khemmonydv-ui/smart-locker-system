<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use App\Models\LockerUsage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\View\View;

class YourLocker extends Controller
{
    // Popup form: create PIN and take the locker
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'locker_id' => ['required', 'exists:lockers,id'],
            'pin'       => ['required', 'digits:6', 'confirmed'],
        ]);

        $locker = DB::transaction(function () use ($data) {
            // lockForUpdate stops two people taking the same locker at the same time
            $locker = Locker::lockForUpdate()->findOrFail($data['locker_id']);

            abort_if($locker->status !== 'available', 409, 'Locker is not available.');

            LockerUsage::create([
                'user_id'    => auth()->id(),
                'locker_id'  => $locker->id,
                'pin_hash'   => Hash::make($data['pin']),
                'start_time' => now(),
                'status'     => 'active',
            ]);

            $locker->update(['status' => 'in_use']);

            return $locker;
        });

        return redirect()->route('locker.show', $locker->name);
    }

    // "Your Locker" page
    public function show(string $code): View
    {
        $usage  = $this->activeUsage($code);
        $locker = $usage->locker()->with('location')->first();

        return view('lockerdetail.yourlocker', [
            'facility' => $locker->location->name,
            'locker' => [
                'code'       => $locker->name,
                'status'     => $locker->status,
                'address'    => $locker->location->address,
                'hours'      => 'Mon–Sun 6:00–22:00',
                'started_at' => Carbon::parse($usage->start_time),
            ],
        ]);
    }

    // Unlock: verify the PIN
    public function unlock(Request $request, string $code): RedirectResponse
    {
        $request->validate([
            'pin' => ['required', 'digits:6'],
        ]);

        $usage = $this->activeUsage($code);

        $key = 'unlock:' . auth()->id() . ':' . $code;

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors(['pin' => "Too many attempts. Try again in {$seconds} seconds."]);
        }

        if (! Hash::check($request->input('pin'), $usage->pin_hash)) {
            RateLimiter::hit($key, 300);
            return back()->withErrors(['pin' => 'Incorrect PIN.']);
        }

        RateLimiter::clear($key);

        // TODO: send the real unlock signal to the locker
        return back()->with('status', "Locker {$code} unlocked.");
    }

    // Release: end the usage and free the locker
    public function release(string $code): RedirectResponse
    {
        DB::transaction(function () use ($code) {
            $usage = $this->activeUsage($code);

            $usage->update([
                'end_time' => now(),
                'status'   => 'completed',
            ]);

            $usage->locker->update(['status' => 'available']);
        });

        return redirect()->route('lockerdetail.index')->with('status', "Locker {$code} released.");
    }

    // The logged-in user's active usage for this locker
    private function activeUsage(string $code): LockerUsage
    {
        return LockerUsage::where('user_id', auth()->id())
            ->where('status', 'active')
            ->whereHas('locker', fn ($q) => $q->where('name', $code))
            ->firstOrFail();
    }
}