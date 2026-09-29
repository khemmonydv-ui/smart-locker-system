<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Locker;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LockerController extends Controller
{
    public function index()
    {
        $lockers = Locker::with('location')->latest()->paginate(10);
        return view('lockers.index', compact('lockers'));
    }

    public function create()
    {
        $locations = Location::orderBy('name')->get();
        return view('lockers.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'name'        => ['required', 'string', 'max:50',
                Rule::unique('lockers', 'name')->where('location_id', $request->location_id)],
            'status'      => 'required|in:available,in_use,maintenance',
            'size'        => 'required|in:small,medium,large',
        ]);

        Locker::create($data);

        return redirect()->route('lockers.index')->with('success', 'Locker created');
    }

    public function show(Locker $locker)
    {
        return redirect()->route('lockers.edit', $locker);
    }

    public function edit(Locker $locker)
    {
        $locations = Location::orderBy('name')->get();
        return view('lockers.edit', compact('locker', 'locations'));
    }

    public function update(Request $request, Locker $locker)
    {
        $data = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'name'        => ['required', 'string', 'max:50',
                Rule::unique('lockers', 'name')->where('location_id', $request->location_id)->ignore($locker->id)],
            'status'      => 'required|in:available,in_use,maintenance',
            'size'        => 'required|in:small,medium,large',
        ]);

        $locker->update($data);

        return redirect()->route('lockers.index')->with('success', 'Locker updated');
    }

    public function destroy(Locker $locker)
    {
        $locker->delete();

        return redirect()->route('lockers.index')->with('success', 'Locker deleted');
    }
}