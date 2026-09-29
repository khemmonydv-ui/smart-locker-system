<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\View\View;

class LockerDetailController extends Controller
{
    // GET /lockerdetail — shows the first location's lockers
    public function index(): View
    {
        return $this->render(Location::orderBy('id')->first());
    }

    // GET /lockerdetail/location/{location} — shows a chosen location
    public function location(Location $location): View
    {
        return $this->render($location);
    }

    private function render(?Location $location): View
    {
        // Pull this location's lockers from the database, sorted A01, A02, B01...
        $lockers = $location
            ? $location->lockers()->orderBy('name')->get()
            : collect();

        return view('lockerdetail.index', compact('location', 'lockers'));
    }
}