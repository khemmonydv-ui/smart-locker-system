<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::with('lockers')->get();
        // dd($locations);
        return view('staff.locations.index', compact('locations'));
    }

    // Store new location
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            
        ]);

        Location::create([
            'name' => $request->name,
            'address' => $request->address,
            
        ]);

        return redirect()
            ->route('locations.index')
            ->with('success', 'Location added successfully!');
    }

    // Show edit form
    public function edit(Location $location)
    {
        return view('staff.locations.edit', compact('location'));
    }

    // Update location
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $location->update([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return redirect()
            ->route('locations.index')
            ->with('success', 'Location updated successfully!');
    }

    // Delete location
    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()
            ->route('locations.index')
            ->with('success', 'Location deleted successfully!');
    }
    
}