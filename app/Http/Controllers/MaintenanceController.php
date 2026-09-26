<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        // TEMPORARY: static data for layout/UI purposes.
        // Swap this for Maintenance::with(['locker', 'assignee'])->latest('reported_at')->get()
        // once the real data is wired up.
        $reports = collect([
            (object) [
                'id'          => 1,
                'locker_code' => 'A05',
                'location'    => 'Central Library',
                'problem'     => "Door latch broken — won't lock properly",
                'reported_at' => '2026-09-08',
                'status'      => 'in_progress',
                'assigned_to' => 'Tom Rivera',
                'is_urgent'   => true,
            ],
            (object) [
                'id'          => 2,
                'locker_code' => 'A05',
                'location'    => 'Central Library',
                'problem'     => "Door latch broken — won't lock properly",
                'reported_at' => '2026-09-08',
                'status'      => 'in_progress',
                'assigned_to' => 'Tom Rivera',
                'is_urgent'   => true,
            ],
            (object) [
                'id'          => 3,
                'locker_code' => 'A05',
                'location'    => 'Central Library',
                'problem'     => "Door latch broken — won't lock properly",
                'reported_at' => '2026-09-08',
                'status'      => 'in_progress',
                'assigned_to' => 'Tom Rivera',
                'is_urgent'   => true,
            ],
        ]);

        // TEMPORARY: static locker list for the "Report Misuse" dropdown.
        $lockers = collect([
            (object) ['id' => 1, 'code' => 'A05', 'location' => 'Central Library'],
            (object) ['id' => 2, 'code' => 'B12', 'location' => 'West Wing'],
        ]);

        return view('staff.maintenance.index', [
            'title'   => 'Maintenance',
            'reports' => $reports,
            'lockers' => $lockers,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'locker_id' => ['required'],
            'problem'   => ['required', 'string', 'max:1000'],
            'is_urgent' => ['sometimes', 'boolean'],
        ]);

        // TEMPORARY: not persisting yet since this is static/demo data.
        // Once wired to the real Maintenance model:
        // Maintenance::create([...]);

        return back()->with('success', 'Misuse report submitted.');
    }

    public function resolve($id)
    {
        // TEMPORARY: no real record to update yet.
        // Maintenance::findOrFail($id)->update(['status' => 'resolved', 'resolved_at' => now()]);

        return back()->with('success', 'Marked as resolved.');
    }
}