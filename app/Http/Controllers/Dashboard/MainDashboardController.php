<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainDashboardController extends Controller
{
    // view page
    public function student(){
        return view('dashboard.student_dashboard');
    }
}
