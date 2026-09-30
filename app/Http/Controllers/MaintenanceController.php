<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use App\Models\Maintenance;
use Illuminate\Http\Request;

/**
 * Staff Maintenance page.
 * Users report a locker problem, and staff see it here and mark it resolved.
 */
class MaintenanceController extends Controller
{
    /**
     * Show all reports: unresolved first, urgent first, newest first.
     */
    public function index()
    {
        $reports = Maintenance::with(['locker.location', 'assignee'])
            // Eager loading avoids running a separate query for every table row.

            // Sort order (important for staff workflow):
            ->orderByRaw("status = 'resolved'") // 1) unresolved reports on top
            ->orderByDesc('is_urgent')          // 2) urgent ones first
            ->latest('reported_at')             // 3) newest first
            ->paginate(15)                      // 15 per page so the page stays fast
            ->through(fn ($m) => (object) [
                // through() reshapes each row and keeps the pagination links working.
                // The keys match what the Blade view already uses, so it needs no rewrite.
                'id'          => $m->id,
                'locker_code' => $m->locker->code,
                'location'    => $m->locker->location->name ?? '—', // adjust to your schema
                'problem'     => $m->problem,
                'reported_at' => $m->reported_at->format('Y-m-d'),
                'status'      => $m->status,
                'assigned_to' => $m->assignee?->name, // null if nobody is assigned
                'is_urgent'   => $m->is_urgent,
            ]);

        // Lockers for the "Report a Problem" dropdown.
        $lockers = Locker::with('location')->orderBy('name')->get();

        return view('staff.maintenance.index', [
            'title'   => 'Maintenance',
            'reports' => $reports,
            'lockers' => $lockers,
        ]);
    }

    /**
     * Save a new problem report.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            // IMPORTANT: "exists" makes sure the locker is real.
            // Without it, anyone could send a fake locker_id.
            'locker_id' => ['required', 'exists:lockers,id'],
            'problem'   => ['required', 'string', 'max:1000'],
            'is_urgent' => ['sometimes', 'boolean'],
        ]);

        Maintenance::create([
            'locker_id'   => $data['locker_id'],

            // IMPORTANT: take the reporter from the login session, NEVER from the
            // form. If it came from the form, a user could report as someone else.
            'user_id'     => auth()->id(),

            'problem'     => $data['problem'],

            // A checkbox sends nothing when unchecked, so boolean() safely returns false.
            'is_urgent'   => $request->boolean('is_urgent'),

            'status'      => Maintenance::STATUS_PENDING,
            'reported_at' => now(),
        ]);

        return back()->with('success', 'Problem report submitted.');
    }

    /**
     * Mark a report as resolved.
     * Laravel finds the record from the {maintenance} URL part (route model binding).
     * If the ID does not exist, the user automatically gets a 404 page.
     */
    public function resolve(Maintenance $maintenance)
    {
        $maintenance->update([
            'status'      => Maintenance::STATUS_RESOLVED,
            'resolved_at' => now(), // keep the time so you can report how long fixes take
        ]);

        return back()->with('success', 'Marked as resolved.');
    }
}