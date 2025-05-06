<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return Inertia::render('Auth/Login');
        }
        return to_route('user.dashboard');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|min:8'
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            return to_route('user.dashboard');
        }
        throw ValidationException::withMessages([
            'login' => 'Invalid Login!',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return to_route('login');
    }
}
