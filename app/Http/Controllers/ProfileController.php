<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Show the logged-in user's profile
    public function index()
    {
        // $profile = $this->currentProfile();

        return view('profile.index');
    }

    // Show the edit form
    public function edit()
    {
        $profile = $this->currentProfile();

        return view('profile.edit', compact('profile'));
    }

    // // Save changes
    // public function update(Request $request)
    // {
    //     $profile = $this->currentProfile();

    //     $validated = $request->validate([
    //         'name'    => 'required|string|max:255',
    //         'email'   => 'required|email|max:255',
    //         'bio'     => 'nullable|string|max:1000',
    //         'phone'   => 'nullable|string|max:20',
    //         'address' => 'nullable|string|max:255',
    //     ]);

    //     $profile->update($validated);

    //     return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
    // }

    // // Get (or create) the profile row for whoever is logged in
    // private function currentProfile(): Profile
    // {
    //     return Profile::firstOrCreate(
    //         ['user_id' => auth()->id()],
    //         [
    //             'name'  => auth()->user()->name,
    //             'email' => auth()->user()->email,
    //         ]
    //     );
    // }
}