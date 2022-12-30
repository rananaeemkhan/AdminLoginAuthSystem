<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.auth.dashboard');
    }
}
