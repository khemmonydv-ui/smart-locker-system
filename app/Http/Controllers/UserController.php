<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Display all users
    public function index()
    {
        $users = User::latest()->get();

        return view('staff.users.index', compact('users'));
    }

    // Add a new user
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'user',
        ]);

        return back()->with('success', 'User added.');
    }

    // Display one user's information
    public function show(User $user)
    {
        return view('staff.users.show', compact('user'));
    }

    // Change user status
    public function toggleStatus(User $user)
    {
        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->save();

        return back()->with('success', 'User status updated.');
    }
}