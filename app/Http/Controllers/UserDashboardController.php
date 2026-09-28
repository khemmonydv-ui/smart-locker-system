<?php

namespace App\Http\Controllers;

use App\Models\Location;

class UserDashboardController extends Controller
{
    public function index()
    {
        return view('users.dashboard', [
            'locations' => Location::orderBy('distance_km')
                ->take(3)
                ->get(),
        ]);
    }
}
