<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RektoratController extends Controller
{
    public function dashboard()
    {
        return view('rektorat.dashboard');
    }
}
