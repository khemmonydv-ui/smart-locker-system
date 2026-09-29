<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // Show all locations
    public function index()
    {
        $locations = Location::latest()->paginate(10);
        return view('locations.index', compact('locations'));
    }

    // Show the "add location" form
    public function create()
    {
        return view('locations.create');
    }

    // Save a new location
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        Location::create($data);

        return redirect()->route('locations.index')->with('success', 'Location created');
    }

    // Show one location
    public function show(Location $location)
    {
        return view('locations.show', compact('location'));
    }

    // Show the "edit location" form
    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    // Save changes to a location
    public function update(Request $request, Location $location)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $location->update($data);

        return redirect()->route('locations.index')->with('success', 'Location updated');
    }

    // Delete a location
    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->route('locations.index')->with('success', 'Location deleted');
    }
}