<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthContrller extends Controller
{
    public function showlogin()
    {
        return view('login.index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    // public function test(Request $request){
    //     dd($request);
    // }

    public function login(Request $request)
    {

        $user = User::where('email', $request->email)
                ->first();

        dd($user);

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();

            return $user->role ===  'staff'
                ? redirect()->intended('/staff/dashboard') 
                : redirect()->intended('/user/dashboard');
        }else{
            return redirect()->back()->withError(['msg' => 'The password and email not match']);
        }
    }
}
