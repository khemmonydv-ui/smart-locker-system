<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

/**
 * Staff Settings page — Admin Account + Change Password only.
 * Both act on the currently logged-in user (auth()->user()).
 */
class SettingsController extends Controller
{
    /**
     * Show the settings page.
     */
    public function index()
    {
        return view('staff.settings', [
            'title' => 'Settings',
            'user'  => auth()->user(),
        ]);
    }

    /**
     * Save admin name + email.
     */
    public function updateAccount(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name'  => ['required', 'string', 'max:100'],
            'email' => [
                'required', 'email', 'max:150',
                // IMPORTANT: ignore($user->id) lets you keep your OWN email
                // without Laravel rejecting it as "already taken".
                Rule::unique('users', 'email')->ignore($user->id),
            ],
        ]);

        $user->update($data);

        return back()->with('success', 'Account details updated.');
    }

    /**
     * Change the logged-in user's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            // Built-in rule: checks the typed password against the real one.
            'current_password' => ['required', 'current_password'],
            'password'          => ['required', 'confirmed', Password::min(8)],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password), // always store a hash, never plain text
        ]);

        return back()->with('success', 'Password changed.');
    }
}