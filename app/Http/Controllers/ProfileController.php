<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::firstOrCreate(
            ['id' => 1],
            [
                'user_id' => 1,
                'name'    => 'New User',
                'email'   => '',
            ]
        );

        return view('.profile.index', compact('profile'));
    }

    public function edit()
    {
        $profile = Profile::findOrFail(1);

        return view('Users.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = Profile::findOrFail(1);

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $profile->update($validated);

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
    }
}