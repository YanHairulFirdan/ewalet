<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showForm()
    {
        return view('admin.login');
    }
    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->except(['_token', '_method']),
            [
                'username' => 'required|string|min:4',
                'password' => 'required|string|min:8'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->getMessageBag());
        }

        $login = Auth::guard('admin')->attempt($request->only(['username', 'password']));

        return $login ? redirect(route('admin.dashboard')) : redirect()->back()->withErrors(['errors' => 'wrong cridential']);
    }

    public function logout(Request $request)
    {
        // logout
    }
}
