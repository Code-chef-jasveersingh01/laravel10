<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
     /**
     * Show the nvr dashboard.
     *
     */
    public function index()
    {

            return view('admin.dashboard.dashboard');

    }
}
