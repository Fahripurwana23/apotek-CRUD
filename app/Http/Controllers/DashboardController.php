<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\FlareClient\View;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }
}
