<?php

namespace App\Http\Controllers;

use App\Models\Location;
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
}
