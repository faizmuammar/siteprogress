<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $role = $request->input('role', 'owner_proyek');
        session(['user_role' => $role]);

        return redirect()->route('home');
    }

    public function logout()
    {
        session()->forget('user_role');
        return redirect()->route('login');
    }
}