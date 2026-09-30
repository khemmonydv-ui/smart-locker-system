<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use Illuminate\Http\Request;

class LockerController extends Controller
{
    // Show all lockers
    public function index()
    {
        $lockers = Locker::with('location')->get();
        
        return view('staff.lockers.index', compact('lockers'));
    }

    // Store new locker
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
            'status' => 'required|string',
            'size' => 'required|string',
        ]);

        Locker::create([
            'name' => $request->name,
            'location_id' => $request->location_id,
            'status' => $request->status,
            'size' => $request->size,
        ]);

        return redirect()
            ->route('lockers.index')
            ->with('success', 'Locker added successfully!');
    }

    // Show edit form
    public function edit(Locker $locker)
    {
        return view('staff.lockers.edit', compact('locker'));
    }

    // Update locker
    public function update(Request $request, Locker $locker)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
            'status' => 'required|string',
            'size' => 'required|string',
        ]);

        $locker->update([
            'name' => $request->name,
            'location_id' => $request->location_id,
            'status' => $request->status,
            'size' => $request->size,
        ]);

        return redirect()
            ->route('lockers.index')
            ->with('success', 'Locker updated successfully!');
    }

    // Delete locker
    public function destroy(Locker $locker)
    {
        $locker->delete();

        return redirect()
            ->route('lockers.index')
            ->with('success', 'Locker deleted successfully!');
    }
}