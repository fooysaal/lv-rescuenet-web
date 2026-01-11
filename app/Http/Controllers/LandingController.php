<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Display the RescueNet landing page.
     */
    public function index()
    {
        return view('layouts.pages.landing');
    }
}
