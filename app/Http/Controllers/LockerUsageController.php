<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LockerUsageController extends Controller
{
    public function index()
    {
        // static demo data — swap this out once locker usage tracking is wired up
        $activeSessions = collect([
            (object) ['locker' => 'A03', 'user' => 'Mony', 'location' => 'Phnom Penh', 'start_time' => '10:35 AM', 'duration' => '01:24', 'status' => 'active'],
            (object) ['locker' => 'A03', 'user' => 'Mony', 'location' => 'Phnom Penh', 'start_time' => '10:35 AM', 'duration' => '01:24', 'status' => 'active'],
            (object) ['locker' => 'A03', 'user' => 'Mony', 'location' => 'Phnom Penh', 'start_time' => '10:35 AM', 'duration' => '01:24', 'status' => 'active'],
            (object) ['locker' => 'A03', 'user' => 'Mony', 'location' => 'Phnom Penh', 'start_time' => '10:35 AM', 'duration' => '01:24', 'status' => 'active'],
            (object) ['locker' => 'A03', 'user' => 'Mony', 'location' => 'Phnom Penh', 'start_time' => '10:35 AM', 'duration' => '01:24', 'status' => 'active'],
        ]);

        $completedSessions = collect([
            (object) ['locker' => 'A03', 'user' => 'Mony', 'location' => 'Phnom Penh', 'start_time' => '10:35 AM', 'duration' => '01:24', 'status' => 'completed'],
            (object) ['locker' => 'A03', 'user' => 'Mony', 'location' => 'Phnom Penh', 'start_time' => '10:35 AM', 'duration' => '01:24', 'status' => 'completed'],
            (object) ['locker' => 'A03', 'user' => 'Mony', 'location' => 'Phnom Penh', 'start_time' => '10:35 AM', 'duration' => '01:24', 'status' => 'completed'],
        ]);

        return view('staff.locker-usage', [
            'activeSessions' => $activeSessions,
            'completedSessions' => $completedSessions,
            'title' => 'Locker Usage',
        ]);
    }
}