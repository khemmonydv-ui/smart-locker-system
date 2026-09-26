<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Locker;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LocationController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $filter = $request->query('filter', 'all'); // 'all' | 'open'

        $locations = Location::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('address', 'like', "%{$search}%");
                });
            })
            ->when($filter === 'open', function ($query) {
                $query->where('is_open', true);
            })
            ->orderBy('distance_km')
            ->get();

        return view('locations.index', [
            'locations' => $locations,
            'search' => $search,
            'filter' => $filter,
        ]);
    }

    public function show(Location $location): View
    {
        $counts = Locker::where('location_id', $location->id)
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        return view('locations.details_locations', [
            'location' => $location,
            'available' => $counts->get('available', 0),
            'inUse' => $counts->get('in_use', 0),
            'maintenance' => $counts->get('maintenance', 0),
        ]);
    }
}
