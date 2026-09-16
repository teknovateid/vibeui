<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function security()
    {
        return view('docs.settings.security');
    }
}
