<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardPageController extends Controller
{
    public function show(string $view){
        return view('docs.dashboard.'.$view);
    }
}
