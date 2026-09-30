<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    // Show login page
    public function showLogin()
    {
        return view('login.index');
    }


    // Login
    public function login(Request $request)
    {
        // Validate
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        // Find user
        $user = User::where('email', $request->email)->first();


        // Check email and password
        if ($user && \Hash::check($request->password, $user->password)) {

            // Login
            Auth::login($user);

            // Regenerate session
            $request->session()->regenerate();


            // Redirect based on role
            if ($user->role === 'staff') {

                return redirect('/staff/dashboard');

            }

            return redirect('/users/dashboard');
        }


        // Login failed
        return back()
            ->withInput($request->only('email'))
            ->with('error', 'The email or password is incorrect.');
    }

    // Show staff register page
    public function showStaffRegister()
    {
        return view('register.staff');
    }


    // Store staff
    public function staffRegister(Request $request)
    {
        // Validate
        $request->validate([
            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email',

            'password' => 'required|min:6|confirmed',
        ]);


        // Create staff
        User::create([
            'name' => $request->name,

            'email' => $request->email,

            'password' => $request->password,

            'role' => 'staff',
        ]);


        // After register → login page
        return redirect('/login')
            ->with('success', 'Staff account created successfully. Please login.');
    }

    // Show user register page
    public function showUserRegister()
    {
        return view('register.user');
    }


    // Store user
    public function userRegister(Request $request)
    {
        // Validate
        $request->validate([
            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email',

            'password' => 'required|min:6|confirmed',
        ]);


        // Create user
        User::create([
            'name' => $request->name,

            'email' => $request->email,

            'password' => $request->password,

            'role' => 'user',
        ]);


        // After register → login page
        return redirect('/login')
            ->with('success', 'User account created successfully. Please login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}