<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a simple dashboard page.
     */
    public function index(Request $request)
    {
        return view('dashboard');
    }
}
