<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LockerDetail extends Controller
{
    public function index()
    {
        return view('lockerdetail.index');
    }
}
