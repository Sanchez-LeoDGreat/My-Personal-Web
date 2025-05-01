<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return Inertia::render('User/Dashboard', [
            'user' => $user
        ]);
    }

    public function home_content_edit()
    {
        $user = Auth::user();
        return Inertia::render('User/Pages/Home', [
            'user' => $user
        ]);
    }

    public function about_content_edit()
    {
        $user = Auth::user();
        return Inertia::render('User/Pages/About', [
            'user' => $user
        ]);
    }
}
