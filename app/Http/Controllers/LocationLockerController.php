<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Locker;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LocationLockerController extends Controller
{
    public function index(Request $request, Location $location): View
    {
        $status = $request->query('status', 'all');
        if (! in_array($status, ['available', 'in_use', 'maintenance'], true)) {
            $status = 'all';
        }

        $counts = Locker::where('location_id', $location->id)
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $lockers = Locker::where('location_id', $location->id)
            ->when($status !== 'all', fn ($query) => $query->where('status', $status))
            ->orderBy('name')
            ->get();

        return view('locations.lockers', [
            'location' => $location,
            'lockers' => $lockers,
            'status' => $status,
            'counts' => $counts,
            'total' => $counts->sum(),
        ]);
    }
}
