<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show()
    {
        session(['page' => '/']);
        return view('dashboard', ['user' => auth()->user()]);

    }
}
