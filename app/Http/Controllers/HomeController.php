<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home');
    }

    public function edit()
    {
        $user = Auth::user();
        return Inertia::render('User/Pages/Home', [
            'user' => $user
        ]);
    }
}
