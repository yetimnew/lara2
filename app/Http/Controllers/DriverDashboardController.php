<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriverDashboardController extends Controller
{
    public function index()
    {
        return view('driver_dashboard');
        // ->with('number_of_trucks', $number_of_trucks)
    }
}
