<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Show all users
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    // Show the "add user" form
    public function create()
    {
        return view('users.create');
    }

    // Save a new user
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:user,admin',
        ]);

        User::create($data);

        return redirect()->route('users.index')->with('success', 'User created');
    }

    // Show one user
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Show the "edit user" form
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Save changes to a user
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6', // empty = keep old password
            'role'     => 'required|in:user,admin',
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated');
    }

    // Delete a user
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted');
    }
}