<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
    }

    public function logout(Request $request)
    {
        // logout
    }
}
